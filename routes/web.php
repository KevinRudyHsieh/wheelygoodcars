<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;


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
// -----------------------------
// Publieke routes
// -----------------------------
// Dit adres toont de 250+ auto's (De Marktplaats)
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

// Dit adres toont alleen JOUW eigen auto's (De Garage)
Route::get('/my-cars', [CarController::class, 'myCars'])->name('cars.my-cars')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
})->name('home');

// -----------------------------
// Aanbieder routes (alleen ingelogd)
// -----------------------------
Route::middleware('auth')->group(function () {
       Route::get('/dashboard/cars', [CarController::class, 'myCars'])->name('cars.my');
        Route::get('/dashboard/cars/create/step-one', [CarController::class, 'createStepOne'])->name('cars.create.one');
        Route::post('/dashboard/cars/create/step-one', [CarController::class, 'postStepOne'])->name('cars.create.one.post');
        Route::get('/dashboard/cars/create/step-two', [CarController::class, 'createStepTwo'])->name('cars.create.two');
        Route::post('/dashboard/cars/store', [CarController::class, 'store'])->name('cars.store');
        Route::get('/dashboard/cars/{car}/pdf', [CarController::class, 'downloadPdf'])->name('cars.pdf');
        Route::delete('/dashboard/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// -----------------------------
// Auth routes (login/register)
// -----------------------------
require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/aanbieders-check', [AdminController::class, 'index'])->name('admin.aanbieders');
    Route::get('/admin/dashboard-b6', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
