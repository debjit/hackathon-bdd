<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return Redirect::to('/admin');

});
Route::get('/cache', function () {
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');


});
Route::get('/storagelink', function () {
    // Artisan::call('storage:link');
    $test = Storage::disk('bb2')->put('example1.txt', 'Contents');
    dd(env('BB2_USE_PATH_STYLE_ENDPOINT'),$test);
});
