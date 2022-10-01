<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::post('/post_message', [HomeController::class, 'post_message']);

Route::get('/post_delete/{id}', [HomeController::class, 'post_delete']);

Route::get('/post_edit_show/{id}', [HomeController::class, 'post_edit_show']);

Route::post('/post_edit/{id}', [HomeController::class, 'post_edit']);

Route::get('/post_search', [HomeController::class, 'post_search']);

Route::get('/my_post_list', [HomeController::class, 'my_post_list']);

Route::post('/post_reply', [HomeController::class, 'post_reply']);

