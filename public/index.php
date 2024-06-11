<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvshowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Genre;
use Html\AppWebPage;

$genre = null;
$tvShowCollection = TvshowCollection::findAll();
try {
    if (isset($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
        $genre = Genre::findById((int) $_GET['genreId']);
        $tvShowCollection = $genre->getTvShow();
    }
} catch(EntityNotFoundException) {
    http_response_code(404);
    header('Location: /');
}

$webPage = new AppWebPage("Séries TV");
$webPage->appendMenu("<a href='admin/tvShow-form.php'>Ajouter</a>");

if ($genre === null) {
    $webPage->appendContent("<div class='filter'>");
    foreach(GenreCollection::findAll() as $genre) {
        $webPage->appendContent("<p><a href='index.php?genreId={$genre->getId()}'>{$genre->getName()}</a></p>");
    }
    $webPage->appendContent("</div>");
} else {
    $webPage->appendMenu("<a href='/'>Réinitialiser</a>");
    $webPage->setTitle("Séries TV - Genre {$genre->getName()}");
}

$webPage->appendContent("<div class='list'>");
foreach($tvShowCollection as $tvShow) {
    $webPage->appendContent(<<<HTML
        <a href="tvshow.php?tvShowId={$tvShow->getId()}">
        <div class="tvShow">
            <div class='tvshow__poster'><img src='/poster.php?posterId={$tvShow->getPosterId()}' alt='Poster de la série {$webPage->escapeString($tvShow->getName())}'></div>
            <div class='tvshow__info'>
                <p class="index__tvshow__name">{$webPage->escapeString($tvShow->getName())}</p>
                <p class="index__tvshow__overview">{$webPage->escapeString($tvShow->getOverview())}</p>
            </div>
        </div>
        </a>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
