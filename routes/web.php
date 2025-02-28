<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    User::latest()->limit(5)->dd()->get();


        //the same function but in old version the only first user will be returned
    User::with(['posts'=> fn ($query)=>$query->latest()->limit(5)])->paginate();
    User::with(['latestPosts'])->paginate();



    dump('Hello World');
    return view('welcome');
});
