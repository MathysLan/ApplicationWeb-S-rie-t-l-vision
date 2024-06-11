<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use PDO;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /**
     * Accesseur de l'Id de la classe season. Renvoie un entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Mutateurs de l'id de la classe Season, prend en paramètre un entier.
     *
     * @param int $id
     * @return void
     */
    private function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur de l'Id de la série Tv de la classe season. Renvoie un entier.
     *
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * Mutateurs de l'id de la classe Season, prend en paramètre un entier.
     *
     * @param int $tvShowId
     * @return void
     */
    public function setTvShowId(int $tvShowId): void
    {
        $this->tvShowId = $tvShowId;
    }

    /**
     * Accesseur du nom de la classe season. Renvoie un entier.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Mutateurs du nom de la classe Season, prend en paramètre un string.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Accesseur renvoyant le nombre de saisons de la classe season. Renvoie un entier.
     *
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * Mutateurs du nombre de saisons de la classe Season, prend en paramètre un entier.
     *
     * @param int $seasonNumber
     * @return void
     */
    public function setSeasonNumber(int $seasonNumber): void
    {
        $this->seasonNumber = $seasonNumber;
    }

    /**
     * Accesseur de l'Id du poster de la classe season. Renvoie un entier.
     *
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Mutateurs de l'id du poster de la classe Season, prend en paramètre un entier.
     *
     * @param int|null $posterId
     * @return void
     */
    public function setPosterId(?int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * Récupère l'instance de la saison à partir de son identifiant
     *
     * @param int $id L'identifiant de la saison
     * @return Season L'instance de Season correspondant à la série
     * @throws Exception\EntityNotFoundException
     */
    public static function findById(int $id): Season
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE id = :seasonId
        SQL
        );
        $req->execute(['seasonId' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Season');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

    /**
     * Liste les épisodes de la saison
     *
     * @return Episode[] Liste des épisodes de la saison
     */
    public function getEpisodes(): array
    {
        return EpisodeCollection::findBySeasonId($this->getId());
    }
}
