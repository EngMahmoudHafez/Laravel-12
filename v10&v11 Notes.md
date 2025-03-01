# 1- corn job
### laravel 10
- the schedule now wrote in the `app/Console/Kernel.php` file.
### laravel 11
- the schedule now wrote in the `routes/console.php` file.
```php
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:end-subscription-notification')
->dailyAt('00:00');
Schedule::command('app:change-subscription-status')
->dailyAt('00:00');
```

# 2- define events
### laravel 10
- the events are defined in the `app/Providers/EventServiceProvider.php` file.
```php 
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
    ],
];
```
### laravel 11
- the events are defined in the `app/Providers/AppServiceProvider.php` file.
```php
    public function boot()
    {
        Event::listen(Registered::class, [SendEmailVerificationNotification::class, 'handle']);
    }
```
