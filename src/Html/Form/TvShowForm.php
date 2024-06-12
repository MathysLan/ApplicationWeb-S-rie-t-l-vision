<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm
{
    use StringEscaper; // On appelle StringEscaper qui nous permettra d'utiliser des méthodes pour protégé et nettoyer les chaines de caractères des query strings

    private ?TvShow $tvShow;

    /**
     * Constructeur public de la classe TvShowForm
     *
     * @param TvShow|null $tvShow L'émission que l'on veut modifier ou rien si l'on créait une nouvelle émission
     */
    public function __construct(?TvShow $tvShow = null)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * Accesseur de la propriété tvShow
     *
     * @return TvShow|null Renvoie l'émission
     */
    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    /**
     * Méthode permettant de récupérer un formulaire html avec l'action passé en paramètre
     *
     * @param string $action Lien vers l'action qui s'effectuera lorsqu'on cliquera sur le bouton enregistrer
     * @return string Renvoie le formulaire sous forme d'un HTML
     */
    public function getHtmlForm(string $action): string
    {
        $nom = $this->escapeString($this?->getTvShow()?->getName());
        $originalName = $this->escapeString($this->getTvShow()?->getOriginalName());
        $homepage = $this->escapeString($this->getTvShow()?->getHomepage());
        $overview = $this->escapeString($this->getTvShow()?->getOverview());
        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <link href="/css/styleForm.css" rel="stylesheet" type="text/css"><title>Formulaire</title>
            </head>
            <form method="post" action="$action">
                <input type="hidden" name="id" value="{$this->getTvShow()?->getId()}">
                <input type="hidden" name="posterId" value="{$this->getTvShow()?->getPosterId()}">  
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
     * @throws ParameterException Erreur s'il manque un paramètre lors de la création d'un tvShow
     */
    public function setEntityFromQueryString(): void
    {
        $id = null;
        $posterId = null;
        if (isset($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $this->escapeString($_POST['id']);
            $id = (int)$this->stripTagsAndTrim($id);
        }
        if (isset($_POST['posterId']) && ctype_digit($_POST['posterId'])) {
            $id = $this->escapeString($_POST['posterId']);
            $id = (int)$this->stripTagsAndTrim($id);
        }
        if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['originalName']) || empty($_POST['originalName'])
            || !isset($_POST['homepage']) || empty($_POST['homepage']) || !isset($_POST['overview']) || empty($_POST['overview'])) {
            throw new ParameterException();
        }
        $tvShow = TvShow::create(
            $this->stripTagsAndTrim($this->escapeString($_POST['name'])),
            $this->stripTagsAndTrim($this->escapeString($_POST['originalName'])),
            $this->stripTagsAndTrim($this->escapeString($_POST['homepage'])),
            $this->stripTagsAndTrim($this->escapeString($_POST['overview'])),
            $id,
            $posterId
        );
        $this->tvShow = $tvShow;
    }
}
