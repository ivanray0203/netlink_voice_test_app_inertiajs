<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/create', [ProductController::class, 'createProduct']);
Route::get('/products/{id}', [ProductController::class, 'showProduct']);
Route::post('/products', [ProductController::class, 'storeProduct']);
Route::put('/products/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
