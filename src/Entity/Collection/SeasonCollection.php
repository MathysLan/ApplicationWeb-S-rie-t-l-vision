<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use PDO;

class SeasonCollection
{
    /**
     * Méthode static renvoyant toutes les saisons avec leur id, leur id d'émission, leur nom, leur numéro de saison et le numéro du poster associé.
     *
     * @param int $tvShowId
     * @return Season[]
     */
    public static function findByTvShowId(int $tvShowId): array
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE tvShowId = :tvShowId
            ORDER BY seasonNumber
        SQL
        );
        $req->execute(['tvShowId' => $tvShowId]);
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\Season");
    }
}
