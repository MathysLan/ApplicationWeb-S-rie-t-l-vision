<?php

declare(strict_types=1);

namespace Entity;

class Episode
{
    private int $id;
    private int $seasonId;
    private string $name;
    private string $overview;
    private int $episodeNumber;

    /**
     * Accesseur de l'Id de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de l'Id de la saison de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * Accesseur du nom de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Accesseur du résumé de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Accesseur du nombre d'épisodes de la classe Episode. Renvoie un entier.
     *
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }


}