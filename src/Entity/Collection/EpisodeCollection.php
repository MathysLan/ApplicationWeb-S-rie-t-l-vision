<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    /**
     * Méthode static renvoyant tous les épisodes avec leur id, leur id de saison, leur nom, leur résumé et le numéro de l'épisode.
     *
     * @param int $SeasonId L'identifiant de la saison pour laquelle on veut récupérer les épisodes.
     * @return Episode[] Retourne un tableau d'objets Episode.
     */
    public static function findBySeasonId(int $SeasonId): array
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY episodeNumber
        SQL
        ); // Préparer une requête SQL pour sélectionner les épisodes d'une saison donnée, triés par numéro d'épisode.
        $req->execute(['seasonId' => $SeasonId]); // Exécuter la requête avec l'identifiant de la saison fourni.
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\Episode"); // Récupérer les résultats sous forme d'objets de la classe Episode et les retourner.
    }
}
