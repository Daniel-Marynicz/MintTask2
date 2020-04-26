# Mint Software Task1 App
======

### Tech

App uses a number of open source projects to work properly:

* [Docker]      - A Enterprise Container Platform
* [Docker Compose] - A a tool for defining and running multi-container Docker applications.
* [Symfony]  - Symfony, High Performance PHP Framework for Web Development
* [Composer]    - A Dependency Manager for PHP
* [PHP_CodeSniffer] PHP_CodeSniffer tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards
* [PHPUnit] The PHP Testing Framework
* [Behat] A php framework for autotesting your business expectations.
* [PHPStan] PHP Static Analysis Tool - discover bugs in your code without running it!
* [Deptrac] Keep your architecture clean.

### Coding standards

The application uses the following coding standards and quality tools:
* [Doctrine Coding Standard]
* [PSR2]
* [PHPStan] at level max

### Installation

App requires [Docker], [Docker Compose] to setup your local development environment. 

You need install latest versions of these apps.

Build Docker instance with:

```sh
$ docker-compose build
```

And start with:

```sh
$ docker-compose up 
```
 
To execute a symfony bin/console you can use

```
$ docker-compose exec php bin/console

```

To run all tests

```
$ docker-compose exec php composer tests

``` 



License
----

PROPRIETARY

**Have fun!**

[//]: # 

   [Symfony]: <http://symfony.com>
   [Docker]: <https://www.docker.com/>
   [Docker Compose]: <https://www.docker.com/>
   [PHPUnit]: <https://phpunit.de>
   [Composer]: <https://getcomposer.org>
   [PHP_CodeSniffer]:  <https://github.com/squizlabs/PHP_CodeSniffer>
   [PHPStan]:   <https://github.com/phpstan/phpstan>
   [Doctrine Coding Standard]:   <https://github.com/doctrine/coding-standard>
   [PSR2]:   <https://www.php-fig.org/psr/psr-2/>
   [Behat]: <https://behat.org/>
   [Deptrac]: <https://github.com/sensiolabs-de/deptrac>

