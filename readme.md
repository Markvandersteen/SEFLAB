# Project Agile Development

Our project is built on the Laravel Framework(version 4.1) with a few packages from [Packagist](http://www.packagist.org).

[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.png)](https://packagist.org/packages/laravel/framework) [![Build Status](https://travis-ci.org/laravel/framework.png)](https://travis-ci.org/laravel/framework)

Laravel Documentation (use it.):

[Laravel Documentation](http://laravel.com/docs)

## Requirements for the Laravel Framework:

* PHP 5.3.7+
* [Composer](https://getcomposer.org/)

## Requirements for this project

* PHP 5.4+
* MySQL 5+

> NOTE: We have used the PHP 5.4 array notation, it can be made 5.3.7+ compatible if that's a must

> NOTE : Apache or another webserver is not needed for development, because we can use the built-in PHP webserver. More further down in this document.

## Packages used:

* [Laravel-Debugbar](https://packagist.org/packages/barryvdh/laravel-debugbar)
* [Keboola CSV reader](https://packagist.org/packages/keboola/csv)

## Commands to be run:

To install the project run in the root folder (after cloning this repository of course):

```sh
composer install
```

OR

```sh
composer update
```

> NOTE for Windows: Make sure php and composer are in your environment variables

## Environments

The default environment is `local`. The local environment has a debugbar and nice stacktraced error messages which is nice for developing.

To actually run in production you can either:

* Make sure the hostname(or domain name) contains `seflab`. This is how it's currently set up. Any machine is a local/development environment, except where the host/domain name contains `seflab`
* Change the code. Write your own environment checker. File `bootstrap/start.php` lines 41-54. It should either return `local` or `production`.

## Database configuration

We are using the MySQL driver for both the local and production environment.

### Local environment

In file `app/config/database.php` change lines 57-60 to match your local database credentials. 

### Production environment

The production environment needs an extra file for the database configuration. This file is not included in this repository because we do not want sensitive information here.

Create a new file in the root called `.env.php` (yes, starting with a .(dot)).

```php
<?php

return array(
    'db_host'     => '127.0.0.1',
    'db_database' => 'database',
    'db_username' => 'username',
    'db_password' => 'password',
);

?>
```

Change to your database credentials.

### Database migrations

To set up the tables, run the migrations via a commandline or terminal:

```sh
php artisan migrate --seed
```

For a production environment:

```sh
php artisan migrate --seed --env="production"
```

## Running a development server

Turn on your MySQL server, then run this command in the root folder:

```sh
php artisan serve
```

OR on Windows:

Double-click `server.bat`

You can view the project in your browser on localhost at port 8000:

`http://localhost:8000/`


## File permissions on Linux/Apache (CHMOD)

CHMOD to 777 these files/folders on a server

`upload`

`app/storage` (recursively, so all subfolders and files as well)