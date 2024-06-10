<?php

declare(strict_types=1);

namespace Entity;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

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
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Mutateurs de l'id du poster de la classe Season, prend en paramètre un entier.
     *
     * @param int $posterId
     * @return void
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }


}
