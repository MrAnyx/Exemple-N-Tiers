# Exemple d'architecture N-Tier
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/35e1dad3a00b484387aee061f55e48f1)](https://www.codacy.com/manual/MrAnyx/Exemple-N-Tiers?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MrAnyx/Exemple-N-Tiers&amp;utm_campaign=Badge_Grade)
![Code Size](https://img.shields.io/github/languages/code-size/MrAnyx/Skeleton-TimePHP)

## Prérequis

Pour pouvoir récuperer et utiliser ce projet, vous devez avoir : 

* [PHP](https://www.php.net/downloads) (7.4.2 ou plus)
* [Python](https://www.python.org/downloads/) (3.8.1 ou plus)
* [MariaDB](https://downloads.mariadb.org/) ou [MySQL](https://dev.mysql.com/downloads/mysql/)
* [Composer](https://getcomposer.org/download/) (optionnel)
* [Git](https://git-scm.com/) (optionnel)

## Installation du projet

Pour récupérer ce projet, si vous possédez Git, il vous suffit juste de la cloner via la commande : 

```bash
git clone https://github.com/MrAnyx/Exemple-N-Tiers.git
```
ou-bien, vous pouvez télécharger l'archive en format ZIP.

Puis navigez dans le dossier du projet.

## Installation des librairies

Commencez par installer la librairie `virtualenv` via pip grâce à la commande suivante : 

```bash 
pip install virtualenv
```

> L'environnement virtuel en Python sert uniquement à installer des librairies pour un projet donné. Elles ne seront pas installée globalement sur votre ordinateur.

On va ensuite créer l'environnement virtuel pour Python. Executez tout simplement la commande suivant : 

```bash
python -m venv venv
```

Il ne reste plus qu'à lancer cet environnement : 

```bash
venv\Script\activate
```

On peut maintenant installer les librairies pour le projet, pour ce faire, executez les commandes suivantes : 

Pour récupérer les librairies PHP, si vous avez Composer d'installé, utilisez la commande suivante : 
```bash
composer install
```

Sinon, utilisez le fichier `composer.phar` à la racine du projet grâce à la commande : 

```bash
php composer.phar install
```

Pour récupérer les librairies du fichier python : 
```bash
pip install -r requirements.txt
```

Vous devez maintenant vous retrouver avec un nouveau dossiers : `vendor` et `venv` contenant respectivement les librairies pour PHP et Python.

## Base de données

Pour que le projet fonctionne, il vous faut créer une base de données que l'on nommera `dbtest`.

Naviguez vers le dossier `bin` de votre dossier de MySQL ou MariaDB puis executez la commande suivante : 

```bash
mysql -u username -p
```
Remplacez `username` par un nom d'utilisateur valide pour la base de données. Entrez ensuite la commande suivante : 

```SQL
CREATE DATABASE dbtest;
```
On a maintenant la base de données il ne reste plus qu'a importer les tables pour le projet. Commencez par sortir de l'invité de commande pour la base de données grâce à la commande : 

```bash
exit
```

Puis lancez la commande suivante : 

```bash
mysql -u username -p dbtest < chemin/du/projet/script.sql
```

On a maintenant le projet, la base de données et les tables `User` et `Article`.

## Ajouter des valeurs dans la base de données

Pour remplir notre base de données, on va utiliser le script Python. Si cela n'est pas déja fait naviguez vers le projet puis ré-activez l'environnement virtuel de Python.

```bash
venv\Script\activate
```

Une fois fait, vous allez devoir changer les valeurs de connexion dans les fichiers `.env` et `config.ini` se trouvant à la racine du projet.

Dans les deux cas, renseignez l'hôte qui héberge la base de données, un nom d'utilisateur valide, son mot de passe aussi que la base que l'on souhaite requêter (ici `dbtest`).

Puis, executez le script Python.

```bash
python seeder.py
```

Vous pouvez maintenant désactiver l'environnment virtuel.

```bash
deactivate
```

Il ne reste plus qu'à lancer le projet et vérifier le résultat.

## Lancement du projet

Vérifiez que vous êtes bien à la racine du projet puis executez la commande suivante : 

```bash
php -S localhost:8000 -t App/public
```
Cette commande sert à lancer le serveur interne de PHP.

Si la commande ne marche pas, vérifiez que le dossier d'installation de PHP se trouve dans les variables d'environnement ainsi que l'extension `PDO`soit activées dans le fichier `php.ini` se trouvant dans votre dossier d'installation de PHP.

Dans le cas ou vous utilisez un logiciel tier tel que : 
* XAMPP
* WampServer
* Laragon
* ...

Vous avez juste à copier le dossier du projet dans le dossier `htdocs` dans le cas de XAMPP ou WampServer. Si vous utilisez Laragon, modifiez le point d'entrez dans les préférences et indiquez `App/public`.

En vous rendand à l'url suivante : 

```
http://localhost:8000/
```

Vous devez apperçevoir la page suivante : 

![https://i.ibb.co/1Q1m5HZ/Capture.png](https://i.ibb.co/1Q1m5HZ/Capture.png)
