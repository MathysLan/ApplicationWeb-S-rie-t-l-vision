<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
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
        $originalName = $this->escapeString($this?->getTvShow()?->getOriginalName());
        $homepage = $this->escapeString($this?->getTvShow()?->getHomepage());
        $overview = $this->escapeString($this?->getTvShow()?->getOverview());
        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <link href="/css/styleForm.css" rel="stylesheet" type="text/css"><title>Formulaire</title>
            </head>
            <form method="post" action="$action">
                <input type="hidden" name="id" value="{$this?->getTvShow()?->getId()}">
                <input type="hidden" name="posterId" value="{$this?->getTvShow()?->getPosterId()}">  
                <input type="text" name="name" value="$nom" required="required" placeholder="Nom">
                <input type="text" name="originalName" value="$originalName" required="required" placeholder="Nom Original"> 
                <input type="url" name="homepage" value="$homepage" required="required" placeholder="Lien vers la série">
                <textarea name="overview" required="required" placeholder="Résumé"  >$overview</textarea>
                <button type="submit">Enregistrer</button>
            </form>
        </html>
        HTML;
    }
    /**
     * Méthode permettant de créer un tvShow à partir des informations dans les query strings
     * @return void
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        $id = null;
        $posterId = null;
        if (isset($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = (int)$this->stripTagsAndTrim($_POST['id']);
        }
        if (isset($_POST['posterId']) && ctype_digit($_POST['posterId'])) {
            $posterId = (int)$this->stripTagsAndTrim($_POST['posterId']);
        }
        if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['originalName']) || empty($_POST['originalName'])
            || !isset($_POST['homepage']) || empty($_POST['homepage']) || !isset($_POST['overview']) || empty($_POST['overview'])) {
            throw new ParameterException();
        }
        $tvShow = TvShow::create(
            $this->stripTagsAndTrim($_POST['name']),
            $this->stripTagsAndTrim($_POST['originalName']),
            $this->stripTagsAndTrim($_POST['homepage']),
            $this->stripTagsAndTrim($_POST['overview']),
            $id,
            $posterId
        );
        $this->tvShow = $tvShow;
    }
}
