<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WEB\JobController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/create', [JobController::class, 'store'])->name('jobs.store');
    Route::get('jobs/show/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('jobs/edit/{id}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('jobs/update/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('jobs/destroy/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

require __DIR__ . '/auth.php';
