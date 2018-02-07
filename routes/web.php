<?php

use App\Jobs\BlinkLight;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('throttle:50,1')->group(function () {
    Route::post('flash', function () {
        dispatch(new BlinkLight(request('color')));

        return redirect('/')->with('success', 'Your blink has been queued!');
    });
});

Route::get('flash', function () {
    return redirect('/');
});
