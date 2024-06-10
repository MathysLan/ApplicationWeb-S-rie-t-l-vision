<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class Poster
{
    private int $id;
    private string $jpeg;

    /**
     * Accesseur de l'id de l'instance Poster. Renvoie un entier
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur renvoyant une chaine de caractère, c'est le jpeg de l'instance Poster
     *
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Méthode statique renvoyant une instance de la classe Poster. Elle prend en paramètre un entier.
     *
     * @param int $id
     * @return Poster
     * @throws EntityNotFoundException
     */
    public static function findById(int $id): Poster #throws EntityNotFoundException
    {
        $requete = <<<SQL
        SELECT id,jpeg
        FROM poster
        WHERE id = ?
        SQL;
        $stmt = MyPDO::getInstance()->prepare($requete);
        $stmt->execute([$id]);
        if (!($ligne = $stmt->fetchObject("Entity\Poster"))) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }
}
