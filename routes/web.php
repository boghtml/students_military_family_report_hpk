<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewerController;
use App\Http\Controllers\ViewerManagementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\StudentRelativeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth']
    ], function () {
        
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('viewers', ViewerManagementController::class);

        Route::resource('students', StudentController::class);
        Route::resource('relatives', RelativeController::class);

        Route::controller(StudentRelativeController::class)
            ->prefix('students-relatives')
            ->name('students-relatives.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });
    });

    
    Route::group([
        'prefix' => 'viewer',
        'as' => 'viewer.',
        'middleware' => ['auth']
    ], function () {
        Route::get('/', [ViewerController::class, 'dashboard'])->name('dashboard');
        Route::get('/students', [ViewerController::class, 'index'])->name('students.index');
    });



    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';