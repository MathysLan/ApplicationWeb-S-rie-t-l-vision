<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\TvShow;

class TvshowCollection
{
    /**
     * Méthode static renvoyant toutes les séries tv avec leur id, leur nom, leur nom original, le lien vers le site où l'on peut regarder la série,
     * la description et l'id du poster associé.
     * @return TvShow[]
     */
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            ORDER BY name
         SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Entity\TvShow");
    }

    /**
     * Méthode static renvoyant toutes les séries par rapport à un Id de genre avec leur id, leur nom, leur nom original, le lien vers le site où l'on peut regarder la série,
     *
     * @param int $genreId Le genre de l'Id où l'on veut les séries associées.
     * @return TvShow[] Ensemble des séries par genre
     */
    public static function findByGenreId(int $genreId): array
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id IN (SELECT tvShowId
                         FROM tvshow_genre
                         WHERE genreId = :genreId)
            ORDER BY name
        SQL
        );
        $req->execute(['genreId' => $genreId]);
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\TvShow");
    }
}
