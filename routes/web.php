<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Page d'accueil (vue par défaut pour tous)
Route::get('/', function () {
    return view('dashboard'); // Page par défaut du dashboard
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

//debut produits

// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    
Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');

// Route pour afficher le formulaire d'ajout de produit
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route pour enregistrer un nouveau produit
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route pour afficher le formulaire de modification d'un produit
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Route pour mettre à jour un produit existant
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comment.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

});
#fin

// Authentification (login/registration/logout)
require __DIR__ . '/auth.php';

