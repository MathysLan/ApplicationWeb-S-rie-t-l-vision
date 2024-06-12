<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use PDO;

class Season
{
    private int $id; // Identifiant de la saison.
    private int $tvShowId; // Identifiant de la série TV à laquelle la saison appartient.
    private string $name; // Nom de la saison.
    private int $seasonNumber; // Numéro de la saison.
    private ?int $posterId; // Identifiant du poster de la saison, nullable.


    /**
     * Accesseur de l'Id de la classe season. Renvoie un entier.
     *
     * @return int Id de la saison
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Mutateurs de l'id de la classe Season, prend en paramètre un entier.
     *
     * @param int $id Nouveau id de la saison
     * @return void
     */
    private function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur de l'Id de la série Tv de la classe season. Renvoie un entier.
     *
     * @return int L'id de l'émission
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * Mutateurs de l'id de l'émission associée à la saison, prend en paramètre un entier.
     *
     * @param int $tvShowId Nouveau id de l'émission
     * @return void
     */
    public function setTvShowId(int $tvShowId): void
    {
        $this->tvShowId = $tvShowId;
    }

    /**
     * Accesseur du nom de la classe season. Renvoie un entier.
     *
     * @return string Nom de la saison
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Mutateurs du nom de la classe Season, prend en paramètre un string.
     *
     * @param string $name Nouveau nom de la saison
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Accesseur renvoyant le nombre de saisons de la classe season. Renvoie un entier.
     *
     * @return int Nombre de saisons de la classe season
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * Mutateurs du nombre de saisons de la classe Season, prend en paramètre un entier.
     *
     * @param int $seasonNumber Le nouveau nombre de saisons
     * @return void
     */
    public function setSeasonNumber(int $seasonNumber): void
    {
        $this->seasonNumber = $seasonNumber;
    }

    /**
     * Accesseur de l'Id du poster de la classe season. Renvoie un entier.
     *
     * @return int|null L'id du poster associé ou null s'il n'en a pas
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Mutateurs de l'id du poster de la classe Season, prend en paramètre un entier.
     *
     * @param int|null $posterId L'id du nouveau poster associé
     * @return void
     */
    public function setPosterId(?int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * Récupère une instance de saison à partir de son identifiant.
     *
     * @param int $id L'identifiant de la saison à récupérer.
     * @return Season L'instance de saison correspondant à l'identifiant.
     * @throws Exception\EntityNotFoundException Si la saison n'est pas trouvée dans la base de données.
     */
    public static function findById(int $id): Season
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE id = :seasonId
        SQL
        ); // Préparation de la requête SQL pour sélectionner une saison par son identifiant.
        $req->execute(['seasonId' => $id]); // Exécution de la requête avec l'identifiant de la saison.
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Season'); // Définition du mode de récupération des résultats comme une instance de Season.
        if (($ligne = $req->fetch()) === false) { // Vérification si aucune ligne n'est retournée.
            throw new Exception\EntityNotFoundException(); // Lancer une exception si la saison n'est pas trouvée.
        }
        return $ligne; // Retourner l'instance de la saison trouvée.
    }

    /**
     * Liste les épisodes de la saison.
     *
     * @return Episode[] Liste des épisodes de la saison.
     */
    public function getEpisodes(): array
    {
        return EpisodeCollection::findBySeasonId($this->getId()); // Appeler la méthode findBySeasonId de EpisodeCollection pour récupérer les épisodes de cette saison.
    }
}
