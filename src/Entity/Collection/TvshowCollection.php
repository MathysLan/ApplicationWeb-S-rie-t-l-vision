<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use PDO;
use Entity\TvShow;

class TvshowCollection
{
    /**
     * Méthode statique renvoyant toutes les séries TV avec leur id, leur nom, leur nom original, le lien vers le site où l'on peut regarder la série,
     * la description et l'id du poster associé.
     *
     * @return TvShow[] Retourne un tableau d'objets TvShow.
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            ORDER BY name
         SQL
        ); // Préparer une requête SQL pour sélectionner toutes les séries TV triées par nom.
        $stmt->execute(); // Exécuter la requête.
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Entity\TvShow"); // Récupérer les résultats sous forme d'objets de la classe TvShow et les retourner.
    }

    /**
     * Méthode statique renvoyant toutes les séries par rapport à un ID de genre avec leur id, leur nom, leur nom original, le lien vers le site où l'on peut regarder la série,
     * la description et l'id du poster associé.
     *
     * @param int $genreId L'identifiant du genre pour lequel on veut récupérer les séries associées.
     * @return TvShow[] Retourne un tableau d'objets TvShow par genre.
     */
    public static function findByGenreId(int $genreId): array
    {
        $req = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id IN (SELECT tvShowId
                         FROM tvshow_genre
                         WHERE genreId = :genreId)
            ORDER BY name
        SQL
        ); // Préparer une requête SQL pour sélectionner les séries TV associées à un genre spécifique, triées par nom.
        $req->execute(['genreId' => $genreId]); // Exécuter la requête avec l'identifiant du genre fourni.
        return $req->fetchAll(PDO::FETCH_CLASS, "Entity\TvShow"); // Récupérer les résultats sous forme d'objets de la classe TvShow et les retourner.
    }
}
