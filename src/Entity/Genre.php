<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Genre
{
    private int $id;
    private string $name;

    /**
     * Accesseur de l'Id du genre
     *
     * @return int L'id du Genre
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur du nom du genre
     *
     * @return string Le nom de genre
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Récupère l'instance du genre à partir de son identifiant
     *
     * @param int $id L'identifiant de la série
     * @return Genre L'instance de TvShow correspondant à la série
     * @throws Exception\EntityNotFoundException
     */
    public static function findById(int $id): Genre
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name
            FROM genre
            WHERE id = :genreId
        SQL
        );
        $req->execute(['genreId' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\Genre');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }


}
