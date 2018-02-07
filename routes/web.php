<?php

use App\Jobs\BlinkLight;

Route::get('/', function () {
    return view('welcome');
});

Route::post('flash', function () {
    dispatch(new BlinkLight(request('color')));

    return redirect('/')->with('message', 'Your blink has been queued!');
});
