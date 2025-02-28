<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    User::latest()->limit(5)->dd()->get();
    dump('Hello World');
    return view('welcome');
});
