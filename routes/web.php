<?php


use App\Http\Controllers\{
    DashboardController,
    HelpdeskCallController,
    UserController
};

use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create/', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


    Route::delete('/helpdesk/{id}', [HelpdeskCallControllerpdeskCallController::class, 'destroy'])->name('helpdesk.destroy');
    Route::put('/helpdesk/{id}', [HelpdeskCallController::class, 'update'])->name('helpdesk.update');
    Route::get('/helpdesk/{id}/edit', [HelpdeskCallController::class, 'edit'])->name('helpdesk.edit');
    Route::get('/helpdesk', [HelpdeskCallController::class, 'index'])->name('helpdesk.index');
    Route::get('/helpdesk/create/', [HelpdeskCallController::class, 'create'])->name('helpdesk.create');
    Route::post('/helpdesk', [HelpdeskCallController::class, 'store'])->name('helpdesk.store');
    Route::get('/helpdesk/{id}', [HelpdeskCallController::class, 'show'])->name('helpdesk.show');
});


Route::get('/', function () {
    return view('welcome');
});
require __DIR__ . '/auth.php';
