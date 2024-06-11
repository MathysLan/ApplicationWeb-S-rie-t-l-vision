<?php

declare(strict_types=1);

use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm
{
    use StringEscaper;

    private ?TvShow $tvShow;

    /**
     * Constructeur public de la classe TvShowForm
     *
     * @param TvShow|null $tvShow
     */
    public function __construct(?TvShow $tvShow = null)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * Accesseur de la propriété tvShow
     *
     * @return TvShow|null
     */
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }



}
