<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


Route::get('/', function () {

    if (Redis::exists('articles.all'))
        return json_decode(Redis::get('articles.all'));


    $articles = \App\Article::all();

    Redis::set('articles.all', $articles);

    return $articles;
});








