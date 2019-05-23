<?php
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
    $visits = Redis::incr("visits");
    return view('welcome')->withVisits($visits);
});
