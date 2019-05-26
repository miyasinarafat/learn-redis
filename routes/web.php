<?php

use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return Cache::remember('articles.all', 60 * 60, function () {
       return \App\Article::all();
    });
});








