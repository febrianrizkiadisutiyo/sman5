<?php

use App\Http\Controllers\guruController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\siswaController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::group(['middleware' => ['auth', 'hakakses:TU,Guru']], function () {
    Route::get('/guru', [guruController::class, 'index']);
    Route::post('/store_guru', [guruController::class, 'store']);
    Route::get('/edit_guru/{id}', [guruController::class, 'edit']);
    Route::put('/update_guru/{id}', [guruController::class, 'update']);
    Route::delete('/delete_guru/{id}', [guruController::class, 'destroy']);
    
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/store_siswa', [SiswaController::class, 'store']);
    Route::get('/edit_siswa/{id}', [SiswaController::class, 'edit']);
    Route::put('/update_siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/delete_siswa/{id}', [SiswaController::class, 'destroy']);



    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/store_kelas', [KelasController::class, 'store']);
    Route::get('/edit_kelas/{id}', [KelasController::class, 'edit']);
    Route::put('/update_kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/delete_kelas/{id}', [KelasController::class, 'destroy']);
});


// Route::get('dashboard', function () {
//     return view('dashboard');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
