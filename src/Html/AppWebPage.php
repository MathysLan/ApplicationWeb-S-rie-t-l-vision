<?php

declare(strict_types=1);

namespace Html;

use Html\WebPage;

class AppWebPage extends WebPage
{
    private string $menu;

    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->menu = '';
        $this->appendCssUrl('/css/style.css');
    }

    /**
     * Accesseur sur le menu de la page Web
     *
     * @return string Contenu du menu de la page Web
     */
    public function getMenu(): string
    {
        return $this->menu;
    }

    /**
     * Mutateur sur le menu de la page Web
     *
     * @param string $menu Contenu du menu de la page Web
     * @return void
     */
    public function appendMenu(string $menu): void
    {
        $this->menu .= $menu;
    }

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
                    <div class="header"><h1>{$this->getTitle()}</h1></div>      
                    <div class="menu">{$this->getMenu()}</div>   
                    <div class="content">
                        {$this->getBody()}
                     </div>
                     <div class="footer">Dernière modification: {$this->getLastModification()}</div>
                     <body>
                </html>
                HTML;
    }
}
