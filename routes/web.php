<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doktor\PeriksaController;
use App\Http\Controllers\Doktor\RiwayatPasienController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
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
    return view('home');
});

Route::group(['prefix' => 'patient'], function () {
    Route::get('/login', [HomeController::class, 'login'])->name('patient.login');
    Route::post('/register', [HomeController::class, 'register'])->name('patient.register');
    Route::get('/home', [PatientController::class, 'index'])->name('patient.home');
    Route::post('/schedule', [PatientController::class, 'getSchedule'])->name('doctor.schedule');
    Route::post('/checkup',[PatientController::class, 'registerCheckup'])->name('patient.checkup');
    Route::get('/medicine', [PatientController::class, 'getMedicine'])->name('patient.getMedicine');
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => 'role:admin'], function () {

        Route::group(['prefix' => '/obat'], function () {
            Route::get('/', [ObatController::class, 'index'])->name('doktor.obat');
            Route::post('/create', [ObatController::class, 'create'])->name('doktor.obat.create');
            Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('doktor.obat.edit');
            Route::post('/update/{id}', [ObatController::class, 'update'])->name('doktor.obat.update');
            Route::get('/delete/{id}', [ObatController::class, 'destroy'])->name('doktor.obat.destroy');
        });
    });

    Route::group(['middleware' => 'role:doctor'], function () {
        Route::get('/periksa', [PeriksaController::class, 'index'])->name('doktor.periksa');
        Route::post('/periksa/finish/{id}',[PatientController::class, 'finishCheckup'])->name('dokter.finishPeriksa');
        Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('doktor.riwayat-pasien');
    });
});
