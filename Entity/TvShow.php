<?php

declare(strict_types=1);

namespace Entity;

class TvShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;

    /**
     * Accessseur de l'attribut id de la classe TvShow
     *
     * @return int L'identifiant du TvShow
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur de l'attribut id de la classe TvShow
     *
     * @param int $id L'identifiant du TvShow
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accessseur de l'attribut name de la classe TvShow
     *
     * @return string Le nom du TvShow
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur de l'attribut name de la classe TvShow
     *
     * @param string $name Le nom du TvShow
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Accessseur de l'attribut originalName de la classe TvShow
     *
     * @return string Le nom original du TvShow
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * Modificateur de l'attribut originalName de la classe TvShow
     *
     * @param string $originalName Le nom original du TvShow
     * @return void
     */
    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    /**
     * Accessseur de l'attribut homepage de la classe TvShow
     *
     * @return string Le lien de streaming pour voir le TvShow
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Modificateur de l'attribut homepage de la classe TvShow
     *
     * @param string $homepage Le lien de streaming pour voir le TvShow
     * @return void
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * Accessseur de l'attribut overview de la classe TvShow
     *
     * @return string Le résumé du TvShow
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Modificateur de l'attribut overview de la classe TvShow
     *
     * @param string $overview Le résumé du TvShow
     * @return void
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * Accessseur de l'attribut posterId de la classe TvShow
     *
     * @return int L'identifiant du poster du TvShow
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Modificateur de l'attribut posterId de la classe TvShow
     *
     * @param int $posterId Le résumé du TvShow
     * @return void
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }
}
