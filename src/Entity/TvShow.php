<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class TvShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TvShow
    {
        $this->name = $name;
        return $this;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): TvShow
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): TvShow
    {
        $this->homepage = $homepage;
        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): TvShow
    {
        $this->overview = $overview;
        return $this;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public function setPosterId(int $posterId): TvShow
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * Récupère l'instance de la série à partir de son identifiant
     *
     * @param int $id L'identifiant de la série
     * @return TvShow L'instance de TvShow correspondant à la série
     * @throws Exception\EntityNotFoundException
     */
    public static function findById(int $id): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id = :tvShowId
        SQL
        );
        $req->execute(['tvShowId' => $id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entity\TvShow');
        if (($ligne = $req->fetch()) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $ligne;
    }

    /**
     * Méthode permettant de supprimer l'artiste correspondant à l'instance de la BD.
     *
     * @return $this L'instance correspondant à la ligne de la BD venant d'être supprimée
     */
    public function delete(): TvShow
    {
        $req = MyPDO::getInstance()->prepare(
            <<<SQL
            DELETE
            FROM tvshow
            WHERE id = :tvShowId
        SQL
        );
        $req->execute(['tvShowId' => $this->getId()]);
        $this->setId(null);
        return $this;
    }
}
