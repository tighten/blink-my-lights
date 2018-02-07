<?php

use App\Jobs\BlinkLight;

Route::get('/', function () {
    return view('welcome');
});

Route::post('flash', function () {
    dispatch(new BlinkLight(request('color')));

    return response()->json(['message' => 'Your blink has been queued!']);
})->middleware('throttle:50,1');

Route::get('flash', function () {
    return redirect('/');
});
