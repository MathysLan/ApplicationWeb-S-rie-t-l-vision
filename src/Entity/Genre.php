<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\TvshowCollection;
use PDO;

class Genre
{
    private int $id; // Propriété privée pour stocker l'identifiant du genre.
    private string $name; // Propriété privée pour stocker le nom du genre.

    /**
     * Accesseur de l'Id du genre.
     *
     * @return int L'id du genre.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur du nom du genre.
     *
     * @return string Le nom du genre.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Récupère l'instance du genre à partir de son identifiant.
     *
     * @param int $id L'identifiant du genre.
     * @return Genre L'instance de Genre correspondant au genre.
     * @throws Exception\EntityNotFoundException Si le genre n'est pas trouvé dans la base de données.
     */
    public static function findById(int $id): Genre
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name
            FROM genre
            WHERE id = :genreId
        SQL
        ); // Préparer une requête SQL pour sélectionner un genre par son identifiant.
        $req->execute(['genreId' => $id]); // Exécuter la requête en utilisant l'identifiant du genre fourni.
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Genre'); // Définir le mode de récupération des résultats sous forme d'objets Genre.
        if (($ligne = $req->fetch()) === false) { // Vérifier si aucun résultat n'est retourné.
            throw new Exception\EntityNotFoundException(); // Si aucun résultat n'est trouvé, lancer une exception EntityNotFoundException.
        }
        return $ligne; // Retourner l'objet Genre trouvé.
    }

    /**
     * Liste les séries de ce genre.
     *
     * @return TvShow[] Liste des séries du genre.
     */
    public function getTvShow(): array
    {
        return TvshowCollection::findByGenreId($this->getId()); // Appeler la méthode findByGenreId de la classe TvshowCollection pour récupérer les séries TV de ce genre.
    }
}
