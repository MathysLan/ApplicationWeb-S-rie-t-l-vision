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
     * @param int $tvShowId L'identifiant de la série TV pour laquelle on veut récupérer les saisons.
     * @return Season[] Retourne un tableau d'objets Season.
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
        ); // Préparer une requête SQL pour sélectionner les saisons d'une série TV donnée, triées par numéro de saison.
        $req->execute(['tvShowId' => $tvShowId]); // Exécuter la requête avec l'identifiant de la série TV fourni.
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\Season"); // Récupérer les résultats sous forme d'objets de la classe Season et les retourner.
    }
}
