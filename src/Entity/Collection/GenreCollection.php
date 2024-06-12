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
     * @return Genre[] Retourne un tableau d'objets Genre.
     */
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name
            FROM genre
            ORDER BY name
         SQL
        ); // Préparer une requête SQL pour sélectionner tous les genres triés par nom.
        $stmt->execute(); // Exécuter la requête.
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Entity\Genre"); // Récupérer les résultats sous forme d'objets de la classe Genre et les retourner.
    }
}
