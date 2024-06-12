# SAE2-01 : Développement d'une application Web

## Auteurs
* LANGINY Mathys (lang0085)
* JADOT-DUFOUR Mattéo (jado0006)

## Description
Ce projet est une application Web de consultation et de modification d'une base de données `MySQL` de séries.
Elle permet de visualiser un ensemble de séries, ainsi que les saisons et les épisodes les composant.
L'application permet également de créer des séries.

## Fonctionnalités du projet
- Consultation de séries, de saisons constituant une série, et d'épisodes constituant une saison
- Filtrage des séries par genre (en cliquant sur le bouton en haut à gauche de la page d'accueil, puis en sélectionnant le genre voulu) avec 
  réinitialisation possible du filtre si celui-ci est sélectionné.
- Ajout d'une série TV via le bouton `Ajouter` de la page d'accueil
- Modification d'une série via le bouton `Modifier` présent sur la page de chaque série
- Suppression d'une série via le bouton `Supprimer` présent sur la page de chaque série
- Bouton de retour à la liste des séries (= l'accueil) présent sur chaque page

## Installation / Configuration
- Récupération du dépot
  ```shell
  https://iut-info.univ-reims.fr/gitlab/lang0085/sae2-01.git
  ```
- Changement de répertoire
  ```shell
  cd sae2-01
  ```
- Installations des dépendances du projet
  ```shell
  composer install
  ```
- Configuration de la base de données à consulter :  
  Il faut créer un fichier `.mypdo.ini` permettant de vous connecter à la base sur laquelle vous allez consulter et modifier les données.
  Pour plus d'informations sur la création de ce fichier, réferez vous à la section "Configuration de la base de données"

## Configuration de la base de données
Il est indispensable de créer un fichier `.mypdo.ini` pour configurer l'accès à sa base de données personnelle.
Le modèle pour ce fichier est disponible ci-dessous. Ce fichier se place à la racine du projet.
```txt
[mypdo]
dsn = "mysql:host=mysql;dbname=your_db_name;charset=utf8"
username = your_login
password = your_mdp
```
Dans ce fichier, il faut remplacer :
- `your_db_name` par le nom de la base de données que vous souhaitez consulter
- `your_login` par votre identifiant pour consulter cette base de données
- `your_mdp` par votre mot de passe

## Mise en route
Voici la commande pour lancer le server Web local :
- Sous Linux :
  ```shell
  composer start:linux
  ```
  ou, en cas de dysfonctionnement du script de lancement :
  ```shell
  php -d display_errors -d auto_prepend_file=%cd%\vendor\autoload.php -S localhost:8000 -t public/
  ```
- Sous Windows
  ```shell
  composer start:windows
  ```
  ou, en cas de dysfonctionnement du script de lancement :
  ```shell
  php -d display_errors -d auto_prepend_file="$PWD/vendor/autoload.php" -S localhost:8000 -t public/
  ```
La consultation du serveur Web se fait via l'URL suivante : [http://localhost:8000/](http://localhost:8000/)

## Style de codage
Nous utilisons un style de codage conforme à PSR-12.  
Commande qui lance une vérification du style du code à blanc sur tous les fichiers :
```shell
composer test:cs
```
Commande qui corrige les erreurs de style de code :
```shell
composer fix:cs
```
Commande qui montre les différences entre les erreurs de style du code, et ce qui devrait être fait :
```shell
php vendor/bin/php-cs-fixer fix --dry-run --diff
```

## Tests
Nous utilisons [PHPUnit](https://phpunit.de/index.html) pour réaliser les tests.  
Il existe diverses commandes de tests utilisant une base de données test jointes à ce dépot et déjà configurée :
- Tests sur la suite de test `Crud` :
  La commande suivante permet de lancer les tests sur la vérification des classes concernant le CRUD. C'est-à-dire les 
  classes de gestion des entités et des collections.
  ```shell
  composer test:crud
  ```
- Tests sur la suite de test `Form`
  La commande suivante permet de lancer les tests sur la vérification des classes concernant l'utilisation des formulaires :
  ```shell
  composer test:form
  ```
- Tests globaux
  La commande suivante permet de lancer tous les tests disponibles (tests sur les suites de tests et tests de style) :
  ```shell
  composer test
  ```
  
## Structure du projet
- /bin : contient les scripts de lancement des serveurs web de consultation et de tests
- /public : racine du serveur Web, contient les pages de consultation du serveur Web
  - /admin : contient les formulaires de création/modification/suppression de séries
  - /css : contient les feuilles de style du projet
  - /img : contient les images et icônes du projet
- /src : contient les classes permettant la gestion des pages Web
  - /Database : classes concernant l'accès à la base de données
  - /Entity : classes de gestion des entités
    - /Collection : classes gérant les collections d'entités
    - /Exception : classes gérant les exceptions
  - /Html : classes concernant la conception des pages Web
    - /Form : classes gérant la conception des formulaires
- /tests : contient les fichiers concernant les tests
  - /Crud : contient les fichiers de tests des éléments de la suite de tests `Crud`
  - /Form : contient les fichiers de tests des éléments de la suite de tests `Form`
  - Crud.suite.yml : fichier de configuration de la suite de tests `Crud`
  - Form.suite.yml : fichier de configuration de la suite de tests `Form`
  - /_date/tvshow-lite.sqlite : bases de données de test
- .gitignore : nomme les fichiers à exclure du Git
- .mypdo.ini : configure l'accès à la base de données [`A créer par l'utilisateur`]
- .mypdo.test.ini : configure l'accès à la base de données de test
- .php-cs-fixer.php : configure l'outil de vérification du style de codage
- codeception.yml : fichier de configuration de l'outil Codeception permettant d'effectuer les tests
- composer.json : défini le projet et les dépendances de celui-ci
- composer.lock : défini clairement les versions des dépendances utilisées (généré automatiquement avec la commande ```composer du``` 
  à partir des informations du fichier composer.json)