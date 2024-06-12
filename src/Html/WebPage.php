<?php

declare(strict_types=1);

namespace Html;

require_once '../vendor/autoload.php';

class WebPage
{
    use StringEscaper;
    private string $head;

    private string $title;
    private string $body;

    /**
     * Constructeur de la classe WebPage, il prend en paramètre un titre en string pour instancier un objet.
     *
     * @param string $title
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
        $this->body = "";
        $this->head = "";
    }

    /**
     * Accesseur du titre. Renvoie le titre sous la forme d'une chaine de caractère.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Accesseur du body. Renvoie le body sous la forme d'une chaine de caractère.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Accesseur du head. Renvoie le head sous la forme d'une chaine de caractère.
     *
     * @return string
     */
    public function getHead(): string
    {

        return $this->head;
    }

    /**
     * Modificateur du titre permettant de modifier le titre avec un titre passé en paramètre.
     *
     * @param string $title Nouveau titre
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Méthode permettant d'ajouter un contenu passé en paramètre sous la forme d'un entier à l'attribut d'instance head.
     *
     * @param string $content Contenue à rajouter.
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;

    }

    /**
     * Méthode permettant d'ajouter à la fin du head le css passé en paramètre sous la forme d'une chaine de caractère
     *
     * @param string $css Css à ajouter à la fin.
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= <<<HTML
            <style>$css</style>

            HTML;


    }

    /**
     * Méthode permettant d'ajouter à la fin du head l'URL passée en paramètre sous la forme d'une chaine de caractère.
     *
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= <<<HTML
            <link href="$url" rel="stylesheet" type="text/css">

            HTML;

    }

    /**
     * Méthode permettant d'ajouter à la fin du head le javascript passé en paramètre sous la forme d'une chaine de caractère.
     *
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head .= <<<HTML
            <script>$js</script>

            HTML;

    }

    /**Méthode permettant d'ajouter à la fin du head l'URL du javascript passée en paramètre sous la forme d'une chaine de caractère.
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= <<<HTML
            <script src="$url"></script>

            HTML;

    }

    /**
     * Méthode permettant d'ajouter à la fin du body le contenu passé en paramètre sous la forme d'une chaine de caractère.
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;

    }

    /**
     * Méthode permettant de créer la page html à partir du titre, du head et du body
     *
     * @return string Renvoie le html.
     */
    public function toHtml(): string
    {
        return <<<HTML
                <!DOCTYPE html>
                <html lang='fr'>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>{$this->getTitle()}</title>
                        {$this->getHead()}
                    </head>               
                    <body>
                        {$this->getBody()}
                     </body>
                </html>
                HTML;
    }

    /**
     * Méthode renvoyant la date de la dernière modification du code.
     *
     * @return string Date de la dernière modification.
     */
    public function getLastModification(): string
    {
        return date("F d Y H:i:s", getlastmod());
    }
}
