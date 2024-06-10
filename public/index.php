<?php

declare(strict_types=1);

use Entity\Collection\TvshowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage("Séries TV");

$tvShowsList = TvshowCollection::findAll();

foreach($tvShowsList as $tvShow) {
    $webPage->appendContent(<<<HTML
        <a href="season.php?tvShowId={$tvShow->getId()}">
        <div class="tvShow">
            <div class='tvshow__poster'><img src='/poster.php?posterId={$tvShow->getPosterId()}' alt='Cover de {$webPage->escapeString($tvShow->getName())}'></div>
            <p class="tvshow__name">{$webPage->escapeString($tvShow->getName())}</p>
            <p class="tvshow__overview">{$webPage->escapeString($tvShow->getOverview())}</p>
        </div>
        </a>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
