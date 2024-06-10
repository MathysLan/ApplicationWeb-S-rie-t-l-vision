<?php

declare(strict_types=1);

namespace Entity;

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
}
