<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('foreach')->with('get', request()->all());
});
