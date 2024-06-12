<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvshowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Genre;
use Html\AppWebPage;

$genre = null; // Initialiser la variable $genre à null, qui contiendra le genre si trouvé.
$tvShowCollection = TvshowCollection::findAll(); // Récupérer toutes les séries TV initialement.
try {
    if (isset($_GET['genreId']) && ctype_digit($_GET['genreId'])) { // Vérifier si 'genreId' est défini dans les paramètres GET et est un chiffre.
        $genre = Genre::findById((int) $_GET['genreId']); // Trouver le genre par ID.
        $tvShowCollection = $genre->getTvShow(); // Obtenir les séries TV associées au genre trouvé.
    }
} catch(EntityNotFoundException) { // Bloc catch pour gérer l'exception EntityNotFoundException.
    http_response_code(404); // Définir le code de réponse HTTP à 404.
    header('Location: /'); // Rediriger vers la page d'accueil.
}

$webPage = new AppWebPage("Séries TV"); // Créer un nouvel objet AppWebPage avec le titre "Séries TV".
$webPage->appendJs("function toggleMenu() {
    var filter = document.querySelector('.filter');
    filter.classList.toggle('active');
}"); // Ajouter le JavaScript pour basculer le menu de filtre.
$webPage->appendMenu(" <a href='admin/tvShow-form.php'>Ajouter</a>"); // Ajouter un élément de menu pour ajouter une nouvelle série TV.

if ($genre === null) { // Vérifier si aucun genre n'est sélectionné.
    $webPage->appendMenu("<button class='burger-menu' onclick='toggleMenu()'><img src='img/icons8-filtre-24.png' alt='Filtre'></button>"); // Ajouter un bouton pour basculer le menu de filtre.
    $webPage->appendContent(" <div class='filter'>");
    foreach(GenreCollection::findAll() as $genre) {
        $webPage->appendContent("<p><a href='index.php?genreId={$genre->getId()}'>{$genre->getName()}</a></p>"); // Ajouter un lien pour chaque genre.
    }
    $webPage->appendContent("</div>");
} else { // Si un genre est sélectionné.
    $webPage->appendMenu("<a href='/'>Réinitialiser</a>"); // Ajouter un élément de menu pour réinitialiser le filtre.
    $webPage->setTitle("Séries TV - Genre {$genre->getName()}"); // Définir le titre de la page web pour inclure le nom du genre.
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
    HTML); // Ajouter chaque série TV avec son affiche, son nom et son aperçu au contenu.
}
$webPage->appendContent("</div>");

echo $webPage->toHTML(); // Afficher le HTML complet de la page web.
