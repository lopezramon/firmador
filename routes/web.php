<?php

use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;


// require __DIR__.'/auth.php';

Route::get('/', function () {
    return Activity::all()->last();
    // return ['Laravel' => app()->version()];
});


