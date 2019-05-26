<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

// lesson 2
Route::get('/videos/{id}', function ($id) {
    $downloads = Redis::get("videos.{$id}.downloads");

    return view('welcome')->withDownloads($downloads);
});

Route::get('/videos/{id}/download', function ($id) {
    Redis::incr("videos.{$id}.downloads");

    return back();
});

// lesson 3
Route::get('articles/trending', function () {
    $trending = Redis::zrevrange('trending_articles', 0, 2);

    $trending = App\Article::hydrate(
        array_map('json_decode', $trending)
    );

    return $trending;
});

Route::get('articles/{article}', function (App\Article $article) {
    Redis::zincrby('trending_articles', 1, $article);

    // remove articles from redis that not trending by cron jobs with console command or schedule
    // Redis::zremrangebyrank('trending_articles', 0, -101);

    return $article;
});

// lesson 4
Route::get('/', function () {
    /*$user3Stats = [
        'favorites' => 1,
        'watchLaters' => 20,
        'completions' => 35
    ];
    Redis::hmset('user.3.stats', $user3Stats);*/


    //$id = session()->get('id');
    //return Redis::hgetall("user.{$id}.stats");

    Cache::put('foo', ['name' => 'Laracasts', 'age' => 3], 100);

    //dd(Cache::get('foo'));

    return Cache::get('foo');
});

Route::get('/users/{id}/stats', function ($id) {

    return Redis::hgetall("user.{$id}.stats");

});

Route::get('/users/{id}/favorite-video', function ($id) {

    Redis::hincrby("user.{$id}.stats", 'favorites', 1);

    return redirect('/')->withId($id);

});








