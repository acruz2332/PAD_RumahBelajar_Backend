<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/akun/{username}/{password}', [App\Http\Controllers\ApiAkunController::class, 'get_password']);

Route::post('/akun/login', [App\Http\Controllers\ApiAkunController::class, 'get_login']);
Route::post('/akun/register', [App\Http\Controllers\ApiAkunController::class, 'register']);

Route::post('/guru/kelas/buat', [App\Http\Controllers\ApiKelasController::class, 'create_class']);
Route::get('/guru/kelas/getall', [App\Http\Controllers\ApiKelasController::class, 'get_all_class']);
Route::post('/guru/kelas/hapus', [App\Http\Controllers\ApiKelasController::class, 'delete_class']);
Route::post('/guru/kelas/hapus/siswa', [App\Http\Controllers\ApiKelasController::class, 'remove_student']);
Route::post('/siswa/kelas/masuk', [App\Http\Controllers\ApiKelasController::class, 'join_class']);

Route::post('/guru/quiz/addquiz', [App\Http\Controllers\ApiQuizController::class, 'add_quiz']);
Route::get('/guru/quiz/getquiz', [App\Http\Controllers\ApiQuizController::class, 'get_quiz']);
Route::get('/guru/quiz/destroy/{token}', [App\Http\Controllers\ApiQuizController::class, 'delete_quiz']);

Route::post('/guru/question/addquestion', [App\Http\Controllers\ApiQuestionController::class, 'add_question']);
Route::get('/guru/question/getquestion/{token}', [App\Http\Controllers\ApiQuestionController::class, 'get_question']);
Route::post('/guru/question/deletequestion', [App\Http\Controllers\ApiQuestionController::class, 'delete_question']);

Route::post('/guru/nilai/storenilai', [App\Http\Controllers\ApiNilaiController::class, 'store_nilai']);
Route::get('/guru/nilai/getnilai/{token}', [App\Http\Controllers\ApiNilaiController::class, 'get_nilai']);

?>