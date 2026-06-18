<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('flash-message');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Student Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/invalid', [StudentController::class, 'invalidAction'])->name('students.invalid');
Route::get('/students/restricted', [StudentController::class, 'restrictedPage'])->name('students.restricted');
Route::get('/students/notice', [StudentController::class, 'systemNotice'])->name('students.notice');

// Old test routes
Route::get('/pdf', [ItemController::class, 'flashMessage'])
    ->name('flash-message');

Route::get('/test-success', [ItemController::class, 'testSuccess'])->name('test.success');
Route::get('/test-error', [ItemController::class, 'testError'])->name('test.error');
Route::get('/test-warning', [ItemController::class, 'testWarning'])->name('test.warning');
Route::get('/test-info', [ItemController::class, 'testInfo'])->name('test.info');

require __DIR__.'/auth.php';
