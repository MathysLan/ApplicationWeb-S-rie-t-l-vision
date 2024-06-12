<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    /**
     * Méthode static renvoyant tous les genres avec leur id et leur nom
     *
     * @return Genre[]
     */
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name
            FROM genre
            ORDER BY name
         SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Entity\Genre");
    }
}
