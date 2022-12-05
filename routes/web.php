<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PanenController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\BakulController;


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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [PanenController::class, 'index'])->name('panen.index');
});

Route::get('add', [PanenController::class, 'create'])->name('panen.create');
Route::post('store', [PanenController::class, 'store'])->name('panen.store');
Route::get('edit/{id}', [PanenController::class, 'edit'])->name('panen.edit'); 
Route::post('update/{id}', [PanenController::class,  'update'])->name('panen.update');
Route::post('delete/{id}', [PanenController::class,  'delete'])->name('panen.delete');
Route::post('softdelete/{id}', [PanenController::class,  'softdelete'])->name('panen.softdelete');

Route::get('bakul/add', [BakulController::class, 'create'])->name('bakul.create');
Route::post('bakul/store', [BakulController::class, 'store'])->name('bakul.store');
Route::get('bakul/edit/{id}', [BakulController::class, 'edit'])->name('bakul.edit');
Route::post('bakul/update/{id}', [BakulController::class, 'update'])->name('bakul.update');
Route::post('bakul/delete/{id}', [BakulController::class, 'delete'])->name('bakul.delete');
Route::post('bakul/softdelete/{id}', [BakulController::class, 'softdelete'])->name('bakul.softdelete');

Route::get('kandang/add', [KandangController::class, 'create'])->name('kandang.create');
Route::post('kandang/store', [KandangController::class, 'store'])->name('kandang.store');
Route::get('kandang/edit/{id}', [KandangController::class, 'edit'])->name('kandang.edit');
Route::post('kandang/update/{id}', [KandangController::class, 'update'])->name('kandang.update');
Route::post('kandang/delete/{id}', [KandangController::class, 'delete'])->name('kandang.delete');
Route::post('kandang/softdelete/{id}', [KandangController::class, 'softdelete'])->name('kandang.softdelete');

Auth::routes();
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
