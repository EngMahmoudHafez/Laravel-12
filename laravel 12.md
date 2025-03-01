# Laravel 12 - New Features and Latest Updates

#### New Starter Kit for Vue, React, and Livewire
- Laravel 12 introduces a new and improved starter kit designed to streamline authentication and front-end integration. Whether you’re using Vue, React, or Livewire, this kit provides a pre-configured setup that eliminates the need for extensive manual configurations.
- you can select which front-end framework you want to use when creating a new Laravel project. This will automatically install the necessary dependencies and set up the project structure for you.
- you can see note here [Laravel 12 - New Starter Kit for Vue, React, and Livewire](https://laravel.com/docs/12.x/starter-kits)

#### Authentication Changes & Security Enhancements
- new `secureValidate()` method, which ensures stricter password policies and more secure form validation.
- laravel 11 `$request->validate(['password' => 'required | min:8']);`
- laravel 12 `$request->secureValidate(['password' => ['required', 'min:8', 'strong']]);`

#### Advanced Query Builder with nestedWhere()
- Writing complex database queries is now easier and more efficient in Laravel 12. The new `nestedWhere()` method simplifies conditions requiring multiple nested functions, making queries cleaner, more readable, and faster to execute.
- laravel 11
```php
$products = DB::table('products')
    ->where('status', 'active')
    ->where(function ($query) {
        $query->where('price', '<', 1000)
              ->orWhere('discount', '>', 20);
    })->get();

```
- laravel 12
```php
$products = DB::table('products')
    ->where('status', 'active')
    ->nestedWhere('price', '<', 1000, 'or', 'discount', '>', 30)
    ->get();

```

#### Improved API Development with GraphQL & Versioning
- laravel 11 `Route::get('/api/v1/users', [UserController::class, 'index']);`
- laravel 12 `Route::apiVersion(1)->group(function () {
    Route::get('users', [UserController::class, 'index']);
});`


#### AI-Powered Debugging Assistant
- Instead of relying on manual debugging methods like dd() or dump(), Laravel 12’s new debug() method provides real-time insights and actionable suggestions.
- laravel 11 `dd($user);`
- laravel 12 `debug($user);`

#### Improved Performance and Scalability
- In previous versions, caching operations relied on synchronous processes, which could cause bottlenecks during heavy loads.
- The introduction of asynchronous caching operations speeds up data retrieval, especially for APIs and applications that frequently update caches.
- laravel 11
```php
use Illuminate\Support\Facades\Cache;

// Caching a user
$user = Cache::remember('user_'.$id, 600, function () use ($id) {
    return User::find($id);
});
```
- laravel 12
```php
use Illuminate\Support\Facades\Cache;
// Utilizing the new async caching API
$user = Cache::asyncRemember('user_'.$id, 600, function () use ($id) {
    return User::find($id);
});
```

#### Enhanced Developer Experience
- laravel 12 introduces a new `artisan` command that generates boilerplate code for common tasks, such as creating models, controllers, and migrations.
- laravel 11 `php artisan make:model Product -mcr`
- laravel 12 `php artisan scaffold Product`

#### Advanced Eloquent ORM Features
- The new features allow developers to define constraints directly within relationship methods, reducing code repetition and improving readability.
- `withFiltered` method eliminates nested callbacks, simplifying relationship filtering.
- laravel 11 
```php
$users = User::with(['posts' => function ($query) {
    $query->where('status', 'published');
}])->get();
```
- laravel 12
```php
$users = User::withFiltered('posts', ['status' => 'published'])->get();
```

## Deprecated Functions in Laravel 12

#### Removal of Soft Deletes::restore() in Global Scopes 
- Laravel 12 removes support for using the `restore()` method in global scopes, emphasizing the need for more explicit and predictable query behaviors.
- Developers are encouraged to override the `restore()` method in individual models instead of relying on global scopes.

#### Deprecation of route() Helper for Non-String Routes
- In Laravel 12, the `route()` helper no longer supports non-string routes, such as arrays or closures.

#### Validation Rule “Same” Deprecated
- The same validation rule is deprecated and replaced with the compare rule for better consistency and more flexible comparisons.
- The compare rule provides broader functionality while maintaining backward compatibility.
```php 
$request->validate([
    'password' => 'required|compare:confirm_password',
]);
```
