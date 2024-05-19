<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect()->route('albums.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::prefix('album')->group(function () {
    Route::get('/', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::get('/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/destroy', [AlbumController::class, 'destroy'])->name('albums.destroy');
    Route::delete('/transfer', [AlbumController::class, 'transferDataAndFiles'])->name('albums.transfer');

});

Route::resource('pictures', PictureController::class)->except('store','destroy');

Route::post('pictures/store/{album}', [PictureController::class,'store'])->name('pictures.store');
Route::delete('pictures/destroy/{album}', [PictureController::class,'destroy'])->name('pictures.destroy');
});

require __DIR__.'/auth.php';
