<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


Route::get('/', function () {

    if ($value = Redis::get('articles.all'))
        return json_decode($value);


    $articles = \App\Article::all();

    Redis::setex('articles.all', 10, $articles);

    return $articles;
});








