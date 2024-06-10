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
     * @return int Renvoie l'id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de l'Id de la saison de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int Renvoie l'id de la saison
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * Accesseur du nom de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string Renvoie le nom de l'épisode
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Accesseur du résumé de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string Renvoie le résumé de l'épisode
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Accesseur du nombre d'épisodes de la classe Episode. Renvoie un entier.
     *
     * @return int Renvoie le nombre correspondant à l'épisode
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }


}