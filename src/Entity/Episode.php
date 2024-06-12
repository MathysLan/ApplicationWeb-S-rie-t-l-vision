<?php

declare(strict_types=1);

namespace Entity;

class Episode
{
    private int $id; // Propriété privée pour stocker l'identifiant de l'épisode.
    private int $seasonId; // Propriété privée pour stocker l'identifiant de la saison à laquelle appartient l'épisode.
    private string $name; // Propriété privée pour stocker le nom de l'épisode.
    private string $overview; // Propriété privée pour stocker le résumé de l'épisode.
    private int $episodeNumber; // Propriété privée pour stocker le numéro de l'épisode dans la saison.

    /**
     * Accesseur de l'Id de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int Renvoie l'id de l'épisode.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de l'Id de la saison de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int Renvoie l'id de la saison à laquelle l'épisode appartient.
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * Accesseur du nom de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string Renvoie le nom de l'épisode.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Accesseur du résumé de l'épisode de la classe Episode. Renvoie un string.
     *
     * @return string Renvoie le résumé de l'épisode.
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Accesseur du numéro de l'épisode de la classe Episode. Renvoie un entier.
     *
     * @return int Renvoie le numéro de l'épisode dans la saison.
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }
}
