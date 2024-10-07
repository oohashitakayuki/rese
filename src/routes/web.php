<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
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
//     return view('welcome');
// });

Route::get('/', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);

Route::middleware('auth')->group(function () {
  Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('detail');
  Route::post('/done/{shop}', [ReservationController::class, 'store'])->name('done');
  Route::delete('/mypage/{shop}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
  Route::post('/shops/{shop}/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
  Route::delete('/shops/{shop}/unfavorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
  Route::get('/mypage', [AuthController::class, 'auth'])->name('mypage');
  Route::get('/thanks', function () {
      return view('thanks');
  });
});