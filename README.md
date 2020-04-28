# Mint Software Task2 App

[![Build Status](https://travis-ci.com/Daniel-Marynicz/MintTask2.svg?branch=master)](https://travis-ci.com/Daniel-Marynicz/MintTask2)

### Tech

App uses a number of open source projects to work properly:

* [PHP] required 7.4 version or later
* [PostgreSQL] The world's most advanced open source database
* [Docker]      - A Enterprise Container Platform
* [Docker Compose] - A a tool for defining and running multi-container Docker applications.
* [Symfony]  - Symfony, High Performance PHP Framework for Web Development
* [Composer]    - A Dependency Manager for PHP
* [PHP_CodeSniffer] PHP_CodeSniffer tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards
* [PHPUnit] The PHP Testing Framework
* [Behat] A php framework for autotesting your business expectations.
* [PHPStan] PHP Static Analysis Tool - discover bugs in your code without running it!
* [KnpPaginatorBundle] SEO friendly Symfony paginator to sort and paginate
* [Behatch contexts] Behat extension provide most common helper steps

### Coding standards

The application uses the following coding standards and quality tools:
#### Doctrine Coding Standard
 The [Doctrine Coding Standard] is a set of rules for [PHP_CodeSniffer]. It is based on [PSR-1]
 and [PSR-2] , with some noticeable exceptions/differences/extensions.
 - Keep the nesting of control structures per method as small as possible
 - Abstract exception class names and exception interface names should be suffixed with ``Exception``
 - Abstract classes should not be prefixed or suffixed with ``Abstract``
 - Interfaces should not be prefixed or suffixed with ``Interface``
 - Concrete exception class names should not be prefixed or suffixed with ``Exception``
 - Align equals (``=``) signs in assignments
 - Add spaces around a concatenation operator ``$foo = 'Hello ' . 'World!';``
 - Add spaces between assignment, control and return statements
 - Add spaces after a negation operator ``if (! $cond)``
 - Add spaces around a colon in return type declaration ``function () : void {}``
 - Add spaces after a type cast ``$foo = (int) '12345';``
 - Use apostrophes for enclosing strings
 - Always use strict comparisons
 - Always add ``declare(strict_types=1)`` at the beginning of a file
 - Always add native types where possible
 - **Omit phpDoc for parameters/returns with native types, unless adding description**
 - Don't use ``@author``, ``@since`` and similar annotations that duplicate Git information
 - Assignment in condition is not allowed
 - Use parentheses when creating new instances that do not require arguments ``$foo = new Foo()``
 - Use Null Coalesce Operator ``$foo = $bar ?? $baz``
 - Prefer early exit over nesting conditions or using else
 
#### PSR-2
The [PSR-2] the most common coding standard among php programmers.
#### PHPStan at level max
[PHPStan] focuses on finding errors in your code without actually running it. It catches whole classes of bugs even before you write tests for the code. It moves PHP closer to compiled languages in the sense that the correctness of each line of the code can be checked before you run the actual line.
#### PHPUnit
Tests in directory `backend/tests`
#### Behat
You can find behat tests in directory `backend/features` and some classes for behat tests in directory `backend/tests/Behat`


### What problems I've had?
`behat/symfony2-extension` had no version for symfony 5 :/.

I solved this problem by adding a package `behat/symfony2-extension` in composer.json in section `repositories` 

### Why i not used FOSUserBundle?

As **FOSUserBundle** is **no longer maintained**, it is **not recommended** to use it in future projects and Symfony 5. If you want more arguments on why not to use it, take a look at this:
https://jolicode.github.io/fosuserbundle-conf/#/

Your safest bet is to implement user authentication on your own using Symfony's documentation on Security:
https://symfony.com/doc/current/security.html

### Installation

App requires [Docker], [Docker Compose] to setup your local development environment. 

You need install latest versions of these apps.

For more information about installing docker please follow the documentation:
* docker https://docs.docker.com/engine/install/
* docker-compose  https://docs.docker.com/compose/install/

After installation on linux systems if you would like to use Docker as a non-root user, you should now consider adding your user to the “docker” group with something like:
```
  sudo usermod -aG docker your-user
```
Remember to log out and back in for this to take effect!
 

#### Build

Build Docker instance with:

```sh
$ docker-compose build
```

#### Set environment (optional)

You can set in the `.env` file your custom environment variables in the main directory of this project .

A list of all environmental variables can be found in  `docker-compose.yml` file.

The most important environmental variables are 
```bash
EXPOSED_POSTGRES_PORT=5432
EXPOSED_NGINX_PORT=80
```

If you already have some services on these ports, you must set these environmental variables in the `.env` file to other values.

#### Start

You can start with:

```sh
$ docker-compose up 
```

End, please ignore errors like:
```
php_1       | 1588079191.992136: There was a problem sending 179 bytes on socket 6: Broken pipe
```
This error comes from xdebug when you are not debugging this application. 

#### Ok, but what now?

By default, app run's on your http://localhost and if you changed the environment variable EXPOSED_NGINX_PORT then app will run on  port selected by you.

In an app you can log in as `demo` user with password `demo`.

The next command's you can need execute  in new terminal window. 
Please do not hit CTRL+C in a window with `docker-compose up` !
 
To execute a symfony's bin/console you can use

```
$ docker-compose exec php bin/console
```

To run all tests (phpcbf, phpcs, phpstan, phpunit, behat) you can run

```
$ docker-compose exec php composer tests
``` 
Or for running only behat test you can run

```
$ docker-compose exec php composer behat
```

To load some fake data you can run
```
docker-compose exec php bin/console doctrine:fixtures:load --append --group=fake
```

#### Stop app

To stop app please hit CTRL+C in a window with `docker-compose up` or if you run this in detached mode
you can run  
```
docker-compose stop
```
To remove containers please run 
```
docker-compose rm
```

License
----

PROPRIETARY

**Have fun!**

[//]: # 
   [PHP]: <https://www.php.net>
   [Symfony]: <http://symfony.com>
   [Docker]: <https://www.docker.com/>
   [Docker Compose]: <https://www.docker.com/>
   [PHPUnit]: <https://phpunit.de>
   [Composer]: <https://getcomposer.org>
   [PHP_CodeSniffer]:  <https://github.com/squizlabs/PHP_CodeSniffer>
   [PHPStan]:   <https://github.com/phpstan/phpstan>
   [Doctrine Coding Standard]:   <https://www.doctrine-project.org/projects/doctrine-coding-standard/en/6.0/reference/index.html#introduction>
   [PSR-2]: <https://www.php-fig.org/psr/psr-2/>
   [PSR-1]: <https://www.php-fig.org/psr/psr-1/>
   [PSR-12]: <https://www.php-fig.org/psr/psr-12/>
   [Behat]: <https://behat.org/>
   [Deptrac]: <https://github.com/sensiolabs-de/deptrac>
   [KnpPaginatorBundle]: <https://github.com/KnpLabs/KnpPaginatorBundle>
   [Behatch contexts]: <https://github.com/Behatch/contexts>
   [PostgreSQL]: <https://www.postgresql.org>
    

