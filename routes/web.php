<?php

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


Route::get('/akun/{username}/{password}', [App\Http\Controllers\ApiAkunController::class, 'get_password']);

Route::post('/akun/login', [App\Http\Controllers\ApiAkunController::class, 'get_login']);
