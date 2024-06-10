<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\TvShow;

class TvshowCollection
{
    /**
     * Méthode static renvoyant toutes les séries tv avec leur id, leur nom, leur nom original, le lien vers le site où l'on peut regarder la sérié,
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
}
