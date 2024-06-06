# SAE2-01
## Membres
* LANGINY Mathys (lang0085)
* JADOT-DUFOUR Mattéo (jado0006)

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

## Serveur Web Local
Commande pour lancer un serveur web local :
- Sous Linux :
  ```shell
  composer start:linux
  ```
- Sous Windows
  ```shell
  composer start:windows
  ```

## Style de codage
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

## Configuration de la base de donnés
Le fichier `.mypdo.ini` contient les informations pour se connecter à la base de données (dsn, login, mdp).