<?php

use Illuminate\Support\Facades\Cache;

class CacheAbleArticles
{
    protected $articles;

    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    public function all()
    {
        return Cache::remember('articles.all', 60 * 60, function () {
            return $this->articles->all();
        });

    }
}


class Articles
{
    public function all()
    {
        return \App\Article::all();
    }
}


Route::get('/', function () {

    $articles = new CacheAbleArticles(new Articles);

    return $articles->all();
});








