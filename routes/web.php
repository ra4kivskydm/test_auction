<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use App\Models\Lot;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [LotController::class, 'index'])->name('index');
Route::resource('category', CategoryController::class);
Route::get('lot/create', [LotController::class, 'create'])->name('lot.create');
Route::post('lot', [LotController::class,'store'])->name('lot.store');
Route::get('lot/{id}', [LotController::class, 'show'])->name('lot.show');
Route::get('lot/{id}/edit', [LotController::class, 'edit'])->name('lot.edit');
Route::put('lot/{id}', [LotController::class, 'update'])->name('lot.update');
Route::delete('lot/{id}', [LotController::class, 'destroy'])->name('lot.delete');
Route::post('filter', [LotController::class, 'filter'])->name('lot.filter');

