# My notes in laracasts course [whats-new-in-laravel-11](https://laracasts.com/series/whats-new-in-laravel-11)
the course is about the new features in laravel 11 and how to use them 
      I use **laravel 12** but the course is still useful for me

## Table of contents
1-  Changes For New Projects 
- [1. Fewer Config Files](#1-fewer-config-files)
- [2. Missing Middleware](#2-missing-middleware)
- [3. Streamlined Scheduling](#3-streamlined-scheduling)
- [4. Installing an API](#4-installing-an-api)
- [5. SQLite Out of the Box](#5-sqlite-out-of-the-box)
2- Changes For All Projects
- [6. The Dumpable Trait](#6-the-dumpable-trait)
- [7. Limitless Limits for Eager Loading](#7-limitless-limits-for-eager-loading)
- [8. Super Simple Memoization](#8-super-simple-memoization)
- [9. A Minor Tweak to Model Casts](#9-a-minor-tweak-to-model-casts)
- [10. Per Second Rate Limits](#10-per-second-rate-limits)
- [11. Retrying Asynchronous Requests](#11-retrying-asynchronous-requests)
- [12. Encryption Key Rotation](#12-encryption-key-rotation)
- [13. No Need for Flags](#13-no-need-for-flags)
- [14. Simple Tests for Complex Jobs](#14-simple-tests-for-complex-jobs)


## 1. Fewer Config Files
- In Laravel 11, the number of configuration files has been reduced.
- to add config file you can use `php artisan config:publish` command
- the service provider is automatically registered for you if you use the `php artisan make:provider (name)` command.
- if  you want to register the service provider manually you can use the `bootstrap/providers.php` file.

## 2. Missing Middleware
- now the middleware live in the framework itself, not in the `app/Http/Middleware` directory.
- the middleware is now registered in the `bootstrap/app.php` file.
- if you want to create a new middleware you can use the `php artisan make:middleware (name)` command.
- to make changes to middleware you can make it in the boot method in the AppServiceProvider class .

## 3. Streamlined Scheduling
- to schedule a command you can use the `php artisan schedule:command` command.
- `php artisan schedule:list ` to list all scheduled commands.
- the schedule now wrote in the `routes/console.php` file.

## 4. Installing an API
- there is now file `routes/api.php` for API routes.
- to install the API you can use the `php artisan install:api` command.
- the same for broadcasting, you can use the `php artisan install:broadcasting` command.

## 5. SQLite Out of the Box
- now SQLite is the default database for new projects.
- you can change the database in the `.env` file.

## 6. The Dumpable Trait
- `dump()` to dump the object.
- `dd()` to dump and die.
- you can use the `Dumpable` trait to add the `dump()` and `dd()` methods to your classes. and you can override the `dump()` method to customize the output what you want.

## 7. Limitless Limits for Eager Loading
- you can use the `limit` method to limit the number of records returned from the database while you make eager loading.

## 8. Super Simple Memoization
- we can memoize any value with a single, simple function called `once`.

## 9. A Minor Tweak to Model Casts
- All Laravel developers are familiar with the `$casts` property. but the new default is a `casts` method instead. 

## 10. Per Second Rate Limits
- rate limiting is now per second instead of per minute.

## 11. Retrying Asynchronous Requests
- you can use the `retry` method to retry asynchronous requests.
- Laravel allows us to make concurrent requests to external APIs using the handy Http::pool method. However, you may have noticed that certain options, like retrying failed requests, aren't supported… until now.

## 12. Encryption Key Rotation
- Occasionally rotating your application's encryption key is considered a good security practice, but it terminates user sessions and can even cause exceptions when old data is encountered! Thankfully, Laravel 11 allows us to keep a list of previous keys that it will check against when decrypting.

## 13. No Need for Flags
- Whilst Laravel has supported both PHPUnit and Pest PHP as testing frameworks for a while now, Pest has always felt a little like a second class citizen. Laravel is now able to determine which test framework you're using, so you never have to remember to use that `--pest` flag.

## 14. Simple Tests for Complex Jobs
- Have you ever wanted to test that a job has been marked as deleted, failed or released? Doing so has been a bit of hack in previous Laravel versions. A shiny `withFakeQueueInteractions` method makes that frustration a thing of the past. For our final episode, let's look at an example.
