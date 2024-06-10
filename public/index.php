<?php

declare(strict_types=1);

use Entity\Collection\TvshowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage("Séries TV");

$webPage->appendContent("<div class='list'>");
foreach(TvshowCollection::findAll() as $tvShow) {
    $webPage->appendContent(<<<HTML
        <a href="tvshow.php?tvShowId={$tvShow->getId()}">
        <div class="tvShow">
            <div class='tvshow__poster'><img src='/poster.php?posterId={$tvShow->getPosterId()}' alt='Poster de la série {$webPage->escapeString($tvShow->getName())}'></div>
            <div class='tvshow__info'>
                <p class="tvshow__name">{$webPage->escapeString($tvShow->getName())}</p>
                <p class="tvshow__overview">{$webPage->escapeString($tvShow->getOverview())}</p>
            </div>
        </div>
        </a>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
