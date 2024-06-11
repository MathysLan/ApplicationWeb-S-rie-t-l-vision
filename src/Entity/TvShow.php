<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class TvShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId;

    private function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TvShow
    {
        $this->name = $name;
        return $this;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): TvShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): TvShow
    {
        $this->homepage = $homepage;
        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): TvShow
    {
        $this->overview = $overview;
        return $this;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public function setPosterId(int $posterId): TvShow
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
            'homepage' => $this->getHomepage(), 'overview' => $this->getOverview(), $this->getPosterId()]);
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
        $this->setId((int) MyPDO::getInstance()->lastInsertId("tvshow"));
        return $this;
    }
}
