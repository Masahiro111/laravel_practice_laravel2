<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/test', 'test');

Route::get('/test', [TestController::class, 'index']);

Route::get('/user', [UserController::class, 'index']);

// Route::get('/user/{id}', function ($id) {
//     return 'User' . $id;
// });

// Route::get('/user/{name?}', function ($name = null) {
//     return 'User' . $name;
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
