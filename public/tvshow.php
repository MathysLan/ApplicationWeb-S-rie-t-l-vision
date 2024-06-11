<?php

declare(strict_types=1);

use Entity\TvShow;
use Html\AppWebPage;

if(!empty($_GET['tvShowId']) && is_numeric($_GET['tvShowId'])) {
    $tvShowId = $_GET['tvShowId'];
} else {
    header('Location: /');
    exit();
}
try {
    $tvShow = TvShow::findById(intval($tvShowId));
} catch (Entity\Exception\EntityNotFoundException $exception) {
    http_response_code(404);
    exit;
}

$webPage = new AppWebPage();
$webPage->setTitle(AppWebPage::escapeString("Séries TV : {$tvShow->getName()}"));
$webPage->appendContent(
    <<<HTML
<div class="tvShow__presentation">
    <div class='tvshow__poster'><img src='/poster.php?posterId={$tvShow->getPosterId()}' alt='Cover de {$webPage->escapeString($tvShow->getName())}'></div>
        <div class="tvShow__texte">
            <p class="tvshow__name">{$webPage->escapeString($tvShow->getName())}</p>
            <p class="tvshow__originalName">{$webPage->escapeString($tvShow->getOriginalName())}</p>
            <p class="tvshow__overview">{$webPage->escapeString($tvShow->getOverview())}</p>
        </div>
</div>
HTML
);
$webPage->appendMenu(<<<HTML
    <a href="index.php">Accueil</a>
    <a href='admin/tvShow-form.php?tvShowId={$tvShow->getId()}&posterId={$tvShow->getPosterId()}'>Modifier</a>
    <a href='admin/tvShow-delete.php?tvShowId={$tvShow->getId()}&posterId={$tvShow->getPosterId()}'>Supprimer</a>
HTML);

$webPage->appendContent("<div class='list'>");
foreach($tvShow->getSeasons() as $season) {
    $webPage->appendContent(<<<HTML
        <a href="season.php?seasonId={$season->getId()}">
        <div class="season">
            <div class='season__poster'><img src='/poster.php?posterId={$season->getPosterId()}' alt='Poster de la saison {$season->getId()}'></div>
            <p class="season__name">{$webPage->escapeString($season->getName())}</p>
        </div>
        </a>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHtml();
