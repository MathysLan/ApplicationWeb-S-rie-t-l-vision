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
     * @return Episode[]
     */
    public static function findBySeasonId(int $SeasonId): array
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY name
        SQL
        );
        $req->execute(['seasonId' => $SeasonId]);
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\Episode");
    }
}