<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ExaminationChildController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RTBUController;
use App\Models\ExaminationChild;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('desa',DesaController::class);
    Route::resource('balita',ChildController::class);
    Route::resource('pemeriksaan', ExaminationChildController::class);
    Route::get('/normal-child',[ExaminationChildController::class,'normal'])->name('normal.child');
    Route::get('/tidak-normal-child',[ExaminationChildController::class,'nonNormal'])->name('!normal.child');
    Route::resource('reference',RTBUController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
