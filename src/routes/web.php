<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);

Route::get('/email/verify', function () {
  return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/thanks');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/thanks', function () {
  return view('thanks');
})->name('thanks');

Route::middleware(['auth','verified'])->group(function () {
  Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('detail');
  Route::post('/done/{shop}', [ReservationController::class, 'store'])->name('done');
  Route::delete('/mypage/{shop}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
  Route::put('/mypage/reservation/{shop}', [ReservationController::class, 'update'])->name('reservation.update');
  Route::post('/shops/{shop}/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
  Route::delete('/shops/{shop}/unfavorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
  Route::post('/mypage/{shop}', [ReviewController::class, 'store'])->name('review.store');
  Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
  Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
});