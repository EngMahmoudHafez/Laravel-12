# My notes in laracasts course [whats-new-in-laravel-11](https://laracasts.com/series/whats-new-in-laravel-11)
the course is about the new features in laravel 11 and how to use them 
      I use **laravel 12** but the course is still useful for me

## Table of contents
1-  Changes For New Projects 
- [1. Fewer Config Files](#1-fewer-config-files)
- [2. Missing Middleware](#2-missing-middleware)
- [3. Streamlined Scheduling](#3-streamlined-scheduling)




## 1. Fewer Config Files
- In Laravel 12, the number of configuration files has been reduced.
- to add config file you can use `php artisan config:publish` command
- the service provider is automatically registered for you if you use the `php artisan make:provider (name)` command.
- if  you want to register the service provider manually you can use the `bootstrap/providers.php` file.

## 2. Missing Middleware 
- now the middleware live in the framework itself, not in the `app/Http/Middleware` directory.
- the middleware is now registered in the `bootstrap/app.php` file.
- if you want to create a new middleware you can use the `php artisan make:middleware (name)` command.
- to make changes to middleware you can make it in the boot method in the AppServiceProvider class .
