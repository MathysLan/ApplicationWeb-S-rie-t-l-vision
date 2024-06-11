<?php

declare(strict_types=1);

use Entity\Collection\EpisodeCollection;
use Entity\Season;
use Entity\TvShow;
use Html\AppWebPage;

if(!empty($_GET['seasonId']) && is_numeric($_GET['seasonId'])) {
    $seasonId = $_GET['seasonId'];
} else {
    header('Location: /');
    exit();
}

try {
    $season = Season::findById(intval($seasonId));
    $tvShow = TvShow::findById(intval($season->getTvShowId()));
} catch (Entity\Exception\EntityNotFoundException $exception) {
    http_response_code(404);
    exit;
}

$webPage = new AppWebPage();
$webPage->setTitle(AppWebPage::escapeString("Séries TV : {$tvShow->getName()} - {$season->getName()}"));
$webPage->appendContent(
    <<<HTML
<nav>
    <a href="index.php">Accueil</a>
</nav>
<div class="season__presentation">
    <div class='tvshow__poster'><img src='/poster.php?posterId={$season->getPosterId()}' alt='Poster de la saison {$season->getSeasonNumber()}'></div>
        <div class="season__text">
            <p class="tvshow__name"><a class="season__lien" href='tvshow.php?tvShowId={$season->getTvShowId()}'>{$webPage->escapeString($tvShow->getName())}</a></p>
            <p class="tvshow__name">{$webPage->escapeString($season->getName())}</p>
        </div>
</div>
HTML
);

$webPage->appendContent("<div class='list'>");
foreach(EpisodeCollection::findBySeasonId(intval($seasonId)) as $episode) {
    $webPage->appendContent(<<<HTML
        <div class="episode">
                <p class='episode__number__titre'>{$episode->getEpisodeNumber()} - {$webPage->escapeString($episode->getName())}</p>

            <p class='episode__overview'>{$webPage->escapeString($episode->getOverview())}</p>
        </div>
        HTML);
}
$webPage->appendContent("</div>");

echo $webPage->toHtml();
