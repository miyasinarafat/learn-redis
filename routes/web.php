<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

interface Articles {
    public function all();
}

class CacheAbleArticles implements Articles
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


class EloquentArticles implements Articles
{
    public function all()
    {
//        return \App\Article::all();
    }
}

App::bind('Articles', function () {
    return new CacheAbleArticles(new EloquentArticles);
});

Route::get('/', function (Articles $articles) {

    return $articles->all();

});








