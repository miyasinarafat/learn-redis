<?php

use Illuminate\Support\Facades\Cache;

class Article {
    public function all()
    {
        return Cache::remember('articles.all', 60 * 60, function () {
            return \App\Article::all();
        });
    }
}


Route::get('/', function (Article $article) {
    return $article->all();
});








