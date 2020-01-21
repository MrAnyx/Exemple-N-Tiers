# Skeleton-TimePHP (not up to date)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/03be85dea858465b8824d41075fd499b)](https://www.codacy.com/manual/MrAnyx/Skeleton-TimePHP?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MrAnyx/Skeleton-TimePHP&amp;utm_campaign=Badge_Grade)
[![GitHub issues](https://img.shields.io/github/issues/MrAnyx/Skeleton-TimePHP)](https://github.com/MrAnyx/Skeleton-TimePHP/issues)
[![GitHub forks](https://img.shields.io/github/forks/MrAnyx/Skeleton-TimePHP)](https://github.com/MrAnyx/Skeleton-TimePHP/network/members)
[![GitHub stars](https://img.shields.io/github/stars/MrAnyx/Skeleton-TimePHP)](https://github.com/MrAnyx/Skeleton-TimePHP/stargazers)
[![GitHub license](https://img.shields.io/github/license/MrAnyx/Skeleton-TimePHP)](https://github.com/MrAnyx/Skeleton-TimePHP/blob/master/LICENSE)
![Repo Size](https://img.shields.io/github/repo-size/MrAnyx/Skeleton-TimePHP)
![Code Size](https://img.shields.io/github/languages/code-size/MrAnyx/Skeleton-TimePHP)
![Maintenance](https://img.shields.io/maintenance/no/2019)

TimePHP is a very simple skeleton to rapidly begin a website.

To be honest, it's not a real MVC pattern but it's still very simple to use. It's principally intended to beginners.

If you want to see an example of how to use this framework, click [here](#example).

## Download
First of all, you need to download [Composer](https://getcomposer.org/download/). If you are more comfortable, you can download [Git](https://git-scm.com/).

In order to retrieve this folder, you have to go to the right folder using CMD, Terminal or any other command prompt and then, write the following commands:

Using Git command

```bash
$ git clone https://github.com/MrAnyx/Skeleton-TimePHP.git name_of_the_project
```

Using Composer create-project command
```bash
$ composer create-project timephp/skeleton --prefer-dist name_of_the_project
```

## Project structure
 ```bash
│   .gitignore
│   LICENSE
│   composer.json
│   composer.lock
│   README.md
├───App
│   ├───includes
│   │       config.php
│   │       functions.php
│   ├───models
│   │   ├───Users
│   │   │       Users.php
│   │   │       UsersRepository.php
│   │   └───Repository
│   │           Repository.php
│   ├───controllers
│   └───views
│       │   index.php
│       └───commons
│               footer.php
│               header.php
│               navbar.php
├───vendor
│   │   autoload.php
│   ├───composer
│   └───splitbrain
└───bin
     └─script.php
 ```
The most important parts of this project are :
* composer.json
* App/
* bin/script.php

The ```App/``` folder contains all you project

### Models
Models are very importants in this structure. Basically, models are objects that represent the differents tables in your database.
For example, if you have a ```User```table that contains three fields : ```id```, ```name```, and ```age``` like this:

|id|  name  |age|
|--|--------|---|
|1 |"Robert"|42 |
|2 | "John" |29 |
|3 |"James" |38 |

You will have to create a php object (class) with ```id```, ```name```and ```àge``` attributes. If you want to see what it looks like,  you can look at the ```App/models/Users``` Model.

You will also have to use the proper ```namespace```.

I recommend you to organize each of your models in a folder that contains the model and ```modelRepository```. A modelRepository is an object that contains functions. Each functions have a precise role for example : get the last user, get the youngest user ... It's these classes that will request the database.

#### Namespaces
A good approach is to name the namespace like this:

You've created a new model here ```App/models/Articles/Article.php``` and ```App/models/Articles/ArticleRepository.php```. I recommend you to name the namespace like this:

```php
<?php
namespace App\Articles;

use PDO; // if you're using PDO

class Article{
  // attributes
  // constructor
  // getters & setters
}
```
You have to add this new namespace to the composer.json file in the autoload section. In this example, you will have to add this line:

```json
"autoload": {
    "psr-4": {
        "App\\": "App/models/",
        "App\\Repository\\": "App/models/Repository/",
        "App\\Users\\": "App/models/Users/",

        "App\\Articles\\": "App/models/Articles"
    }
  }
```

If your new classes are not detected by the autoloader, try this command and it should resolve the problem :
```bash
$ composer dump-autoload
```

### Controllers

A controller is an object the regroup all the modelRepository function for a page. I recommend you to call your controllers with the name of the page like this : ```indexController.php```

As the Models, you have to do the same manipulation with the namespace.

A controller take an Repository object as a parameter. Thank's to this, it prevent the multiple connection and disconnection of the database.

### Views

A view is the file that willl be displayed to the user. At the very top of the file, your will have to require the header file like this :
```php
<?php
require __DIR__ . '/commons/header.php';
```

And below this line, you will set the different variables that will be used in your webpage.
You don't need to recreate the Repository object, it's already done in the ```header.php```file.

## Script
In order to create controllers, models and views more easily, the php-cli library was made for it. To execute the script just execute the following command :
```bash
$ php bin/script.php
```
You will see the differents possibilities.

<h2 id="example">Example</h2>
In this example, we will see how to use this framework using the different features.

## Future Features
* Example to explaine how to use this framework properly.

## Related content
* [Packagist](https://packagist.org/packages/timephp/skeleton) page.
* [GitHub](https://github.com/MrAnyx/Skeleton-TimePHP) page.
* [README](https://mranyx.github.io/Skeleton-TimePHP/) page.

## FAQ
If you have any question or advice, feel free to contact me.

:computer: Happy Coding :heart:
