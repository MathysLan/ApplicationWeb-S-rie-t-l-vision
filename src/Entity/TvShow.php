<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use PDO;

class TvShow
{
    private ?int $id; // Identifiant de l'émission.
    private string $name; // Nom de l'émission
    private string $originalName; // Nom original de l'émission
    private string $homepage; // Lien vers l'émission
    private string $overview; // Résumé de l'émission
    private ?int $posterId; // Poster de l'émission

    /**
     * Constructeur privé de la classe TvShow
     *
     * Empêche l'instanciation directe de la classe.
     */
    private function __construct()
    {
    }

    /**
     * Accesseur de l'ID de la série.
     *
     * @return int|null L'ID de la série ou null si non défini.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Mutateur de l'ID de la série.
     *
     * @param int|null $id L'ID de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    private function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Accesseur du nom de la série.
     *
     * @return string Le nom de la série.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Mutateur du nom de la série.
     *
     * @param string $name Le nom de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    public function setName(string $name): TvShow
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Accesseur du nom original de la série.
     *
     * @return string Le nom original de la série.
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * Mutateur du nom original de la série.
     *
     * @param string $originalName Le nom original de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    public function setOriginalName(string $originalName): TvShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * Accesseur de la page d'accueil de la série.
     *
     * @return string La page d'accueil de la série.
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Mutateur de la page d'accueil de la série.
     *
     * @param string $homepage La page d'accueil de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    public function setHomepage(string $homepage): TvShow
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * Accesseur du résumé de la série.
     *
     * @return string Le résumé de la série.
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Mutateur du résumé de la série.
     *
     * @param string $overview Le résumé de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    public function setOverview(string $overview): TvShow
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * Accesseur de l'ID de l'affiche de la série.
     *
     * @return int|null L'ID de l'affiche de la série.
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Mutateur de l'ID de l'affiche de la série.
     *
     * @param int|null $posterId L'ID de l'affiche de la série.
     * @return TvShow L'instance de la série pour le chaînage de méthodes.
     */
    public function setPosterId(?int $posterId): TvShow
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * Récupère l'instance de la série à partir de son identifiant
     *
     * @param int $id L'identifiant de la série
     * @return TvShow L'instance de TvShow correspondant à la série
     * @throws Exception\EntityNotFoundException
     */
    public static function findById(int $id): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id = :tvShowId
        SQL
        );
        $req->execute(['tvShowId' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\TvShow');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

    /**
     * Méthode permettant de supprimer la série correspondant à l'instance de la BD.
     *
     * @return $this L'instance correspondant à la ligne de la BD venant d'être supprimée
     */
    public function delete(): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            DELETE
            FROM tvshow
            WHERE id = :tvShowId
        SQL
        );
        $req->execute(['tvShowId' => $this->getId()]);
        $this->setId(null);
        return $this;
    }

    /**
     * Méthode permettant de créer une série.
     *
     * @param string $name Nom de la série
     * @param string $originalName Nom original de la série
     * @param string $homepage Lien vers un site de streaming permettant de voir la série
     * @param string $overview Résumé de la série
     * @param int|null $posterId Poster de la série
     * @param int|null $id Identifiant de la série
     * @return TvShow
     */
    public static function create(string $name, string $originalName, string $homepage, string $overview, ?int $id = null, ?int $posterId = null): TvShow
    {
        $tvShow = new TvShow();
        $tvShow->setId($id);
        $tvShow->setName($name);
        $tvShow->setOriginalName($originalName);
        $tvShow->setHomepage($homepage);
        $tvShow->setOverview($overview);
        $tvShow->setPosterId($posterId);
        return $tvShow;
    }

    /**
     * Enregistre une série dans la BD
     *
     * @return $this La série enregistrée
     */
    public function save(): TvShow
    {
        if ($this->getId() === null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    /**
     * Met à jour une série dans la BD
     *
     * @return $this La série mise à jour
     */
    protected function update(): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            UPDATE tvshow
            SET name = :name,
                originalName = :originalName,
                homepage = :homepage,
                overview = :overview,
                posterId = :posterId
            WHERE id = :tvShowId
        SQL
        );
        $req->execute(['name' => $this->getName(), 'tvShowId' => $this->getId(), 'originalName' => $this->getOriginalName(),
            'homepage' => $this->getHomepage(), 'overview' => $this->getOverview(), 'posterId' => $this->getPosterId()]);
        return $this;
    }

    /**
     * Insère une série dans la BD
     *
     * @return $this La série insérée
     */
    protected function insert(): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            INSERT INTO tvshow(name, originalName, overview, homepage, posterId)
            VALUES (:name, :originalName, :overview, :homepage, :posterId)
        SQL
        );
        $req->execute(['name' => $this->getName(), 'originalName' => $this->getOriginalName(), 'overview' => $this->getOverview(),
            'homepage' => $this->getHomepage(), 'posterId' => $this->getPosterId()]);
        $this->setId((int)MyPDO::getInstance()->lastInsertId("tvshow"));
        return $this;
    }

    /**
     * Liste les saisons de la série
     *
     * @return TvShow[] Tableau des saisons de l'émission
     */
    public function getSeasons(): array
    {
        return SeasonCollection::findByTvShowId($this->getId());
    }
}
