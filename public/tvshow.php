<?php

declare(strict_types=1);

use Entity\TvShow;
use Html\AppWebPage;

if(!empty($_GET['tvShowId']) && is_numeric($_GET['tvShowId'])) { // Vérifier si 'tvShowId' est défini dans les paramètres GET et est numérique.
    $tvShowId = $_GET['tvShowId']; // Récupérer l'identifiant de la série TV.
} else { // Si 'tvShowId' n'est pas défini ou n'est pas valide.
    header('Location: /'); // Rediriger vers la page d'accueil.
    exit(); // Terminer l'exécution du script.
}

try {
    $tvShow = TvShow::findById(intval($tvShowId)); // Trouver la série TV par ID.
} catch (Entity\Exception\EntityNotFoundException $exception) { // Bloc catch pour gérer l'exception EntityNotFoundException.
    http_response_code(404); // Définir le code de réponse HTTP à 404.
    exit; // Terminer l'exécution du script.
}

$webPage = new AppWebPage();
$webPage->setTitle(AppWebPage::escapeString("Séries TV : {$tvShow->getName()}")); // Définir le titre de la page web pour inclure le nom de la série TV.
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
); // Ajouter le contenu HTML pour la présentation de la série TV, incluant le poster, le nom et l'aperçu de la série.

$webPage->appendMenu(<<<HTML
    <a href="index.php">Accueil</a>
    <a href='admin/tvShow-form.php?tvShowId={$tvShow->getId()}&posterId={$tvShow->getPosterId()}'>Modifier</a>
    <a href='admin/tvShow-delete.php?tvShowId={$tvShow->getId()}&posterId={$tvShow->getPosterId()}'>Supprimer</a>
HTML
); // Ajouter des éléments de menu pour revenir à l'accueil, modifier ou supprimer la série TV.

$webPage->appendContent("<div class='list'>");
foreach($tvShow->getSeasons() as $season) {
    $webPage->appendContent(<<<HTML
        <a href="season.php?seasonId={$season->getId()}">
        <div class="season">
            <div class='season__poster'><img src='/poster.php?posterId={$season->getPosterId()}' alt='Poster de la saison {$season->getId()}'></div>
            <p class="season__name">{$webPage->escapeString($season->getName())}</p>
        </div>
        </a>
    HTML); // Ajouter chaque saison avec son poster et son nom au contenu.
}
$webPage->appendContent("</div>");

echo $webPage->toHtml(); // Afficher le HTML complet de la page web.
