<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/dashboard', function () {
    return view('layouts.main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students', [StudentController::class, 'index'])->name('students')->middleware('can:students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create')->middleware('can:students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store')->middleware('can:students.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show')->middleware('can:students.show');
    Route::get('/studens/{student}/edit', [StudentController::class, 'edit'])->name('students.edit')->middleware('can:students.edit');
    Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update')->middleware('can:students.update');
    Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy')->middleware('can:students.destroy');
});



require __DIR__ . '/auth.php';

