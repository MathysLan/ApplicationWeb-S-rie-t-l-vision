<?php

declare(strict_types=1);

namespace Entity;

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


}
