<?php
use Illuminate\Support\Facades\Redis;

Route::get('/videos/{id}', function ($id) {
    $downloads = Redis::get("videos.{$id}.downloads");

    return view('welcome')->withDownloads($downloads);
});

Route::get('/videos/{id}/download', function ($id) {
    Redis::incr("videos.{$id}.downloads");

    return back();
});

Route::get('articles/trending', function () {
    $trending = Redis::zrevrange('trending_articles', 0, 2);

    $trending = App\Article::hydrate(
        array_map('json_decode', $trending)
    );

    dd($trending);

    return $trending;
});

Route::get('articles/{article}', function (App\Article $article) {
    Redis::zincrby('trending_articles', 1, $article);

    // remove articles from redis that not trending by cron jobs with console command or schedule
    // Redis::zremrangebyrank('trending_articles', 0, -101);

    return $article;
});





