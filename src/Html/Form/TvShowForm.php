<?php

declare(strict_types=1);

namespace Html\Form;

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

    /**
     * Méthode permettant de récupérer un formulaire html avec l'action passé en paramètre
     *
     * @param string $action
     * @return string
     */
    public function getHtmlForm(string $action): string
    {
        $nom = $this->escapeString($this?->getTvShow()?->getName());
        $originalName = $this->escapeString($this?->getTvShow()->getOriginalName());
        $homepage = $this->escapeString($this?->getTvShow()->getHomepage());
        $overview = $this->escapeString($this?->getTvShow()->getOverview());
        return <<<HTML
        <form method="post" action="$action">
            <input type="hidden" name="id" value="{$this?->getTvShow()?->getId()}"> 
            <input type="text" name="name" value="$nom" required="required">
            <input type="text" name="originalName" value="$originalName" required="required">
            <input type="url" name="homepage" value="$homepage" >
            <input type="text" name="overview" value="$overview"  required="required">
            <label for="name">Nom</label><button type="submit">Enregistrer</button>
        </form>
        HTML;
    }

}
