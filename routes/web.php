<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doktor\PeriksaController;
use App\Http\Controllers\Doktor\RiwayatPasienController;
use App\Http\Controllers\Admin\ObatController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //default jetstream dashboard
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/dashboard', [PeriksaController::class, 'index'])->name('doktor.periksa');
        Route::group(['prefix' => '/obat'],function(){
            Route::get('/', [ObatController::class, 'index'])->name('doktor.obat');
            Route::post('/create',[ObatController::class, 'create'])->name('doktor.obat.create');
            Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('doktor.obat.edit');
            Route::post('/update/{id}', [ObatController::class, 'update'])->name('doktor.obat.update');
            Route::get('/delete/{id}', [ObatController::class, 'destroy'])->name('doktor.obat.destroy');
        });
    });

    Route::group(['middleware' => 'role:doctor'], function () {
        // Routes accessible only by users with the 'admin' role
    });
});

Route::get('/periksa', [PeriksaController::class, 'index'])->name('doktor.periksa');
Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('doktor.riwayat-pasien');
