<?php

declare(strict_types=1);

use Entity\Collection\TvshowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage("Séries TV");

$tvShowsList = TvshowCollection::findAll();

foreach($tvShowsList as $tvShow) {
    $webPage->appendContent(<<<HTML
        <div class="tvShow">
            <div class='album__cover'><img src='/poster.php?posterId={$tvShow->getPosterId()}' alt='Cover de {$webPage->escapeString($tvShow->getName())}'></div>
            <p class="tvshow__name">{$webPage->escapeString($tvShow->getName())}</p>
            <p class="tvshow__name">{$webPage->escapeString($tvShow->getOverview())}</p>
        </div>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
