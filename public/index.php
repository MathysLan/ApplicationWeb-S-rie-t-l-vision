<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvshowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Genre;
use Html\AppWebPage;

try {
    if (isset($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
        $genre = Genre::findById((int) $_GET['genreId']);
        $tvShowCollection = $genre->getTvShow();
    } else {
        $genre = null;
        $tvShowCollection = TvshowCollection::findAll();
    }
} catch(EntityNotFoundException) {
    http_response_code(404);
    header('Location: /');
}

$webPage = new AppWebPage("Séries TV");

// A COMPACTER
if ($genre === null) {
    $webPage->appendContent(<<<HTML
    <nav>
        <a href='admin/tvShow-form.php'>Ajouter</a>
    </nav>
    <div class='filter'>
HTML);
    foreach(GenreCollection::findAll() as $genre) {
        $webPage->appendContent("<p><a href='index.php?genreId={$genre->getId()}'>{$genre->getName()}</a></p>");
    }

} else {
    $webPage->appendContent(<<<HTML
    <nav>
        <a href='/'>Réinitialiser</a>
        <a href='admin/tvShow-form.php'>Ajouter</a>
    </nav>
    <div class='filter'>
HTML);
    $webPage->setTitle("Séries TV - Genre {$genre->getName()}");
}

$webPage->appendContent("</div><div class='list'>");
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
