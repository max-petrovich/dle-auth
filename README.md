# maxic/laravel-dle-auth

Пакет для Laravel 5, позволяющий связать Ваше Laravel приложение с CMS DLE, на основе laravel auth driver. Ваше laravel приложение будет использовать общую авторизацию с CMS DLE.

## Install

Via Composer

``` bash
$ composer require maxic/laravel-dle-auth
```

## Usage

``` php
Добавьте сервис-провайдер пакет в Ваш config/app.php
'Maxic\DleAuth\DleAuthServiceProvider',
В config/auth.php измение поле 'driver' на
'driver' => 'dleauth',
```

``` php
Добавьте в App/Http/Kernel в $middleware
'Maxic\DleAuth\Middleware\Authenticate'
```