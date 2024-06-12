<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Poster
{
    private int $id; // Propriété privée pour stocker l'identifiant du poster.
    private string $jpeg; // Propriété privée pour stocker le contenu JPEG du poster.

    /**
     * Accesseur de l'id de l'instance Poster. Renvoie un entier.
     *
     * @return int L'identifiant du poster.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur renvoyant une chaîne de caractères, c'est le JPEG de l'instance Poster.
     *
     * @return string Le contenu JPEG du poster.
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Méthode statique renvoyant une instance de la classe Poster. Elle prend en paramètre un entier.
     *
     * @param int $id L'identifiant du poster à rechercher.
     * @return Poster L'instance de Poster correspondant à l'identifiant.
     * @throws EntityNotFoundException Si le poster n'est pas trouvé dans la base de données.
     */
    public static function findById(int $id): Poster
    {
        $request = <<<SQL
        SELECT id, jpeg
        FROM poster
        WHERE id = ?
        SQL; // Définition de la requête SQL pour récupérer le poster par son identifiant.
        $stmt = MyPDO::getInstance()->prepare($request); // Préparation de la requête SQL.
        $stmt->execute([$id]); // Exécution de la requête SQL avec l'identifiant du poster.
        if (!($ligne = $stmt->fetchObject("Entity\Poster"))) { // Vérification si le poster est trouvé.
            throw new EntityNotFoundException(); // Si le poster n'est pas trouvé, lancer une exception EntityNotFoundException.
        }
        return $ligne; // Retourner l'instance de Poster trouvée.
    }
}
