<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\EmailController;

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

Route::get('/register', [RegisteredUserController::class, 'register']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/confirm/{token}', [RegisteredUserController::class, 'confirmEmail'])->name('confirm.email');
Route::get('/login', [ShopController::class, 'login'])->name('login');
Route::get('/signIn', [AuthenticatedSessionController::class, 'store']);
Route::get('/thanks', [ShopController::class, 'thanks']);
Route::get('/menu', [ShopController::class, 'menu']);
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail.page');
    Route::post('/shop-ratings', [ShopController::class, 'rating'])->name('shop-ratings.rating');
    Route::get('/get-result', [ShopController::class, 'getResult'])->name('getResult');
    Route::get('/favorite/status', [ShopController::class, 'getStatus']);
    Route::post('/favorite/toggle', [ShopController::class, 'toggle'])->name('favorite.toggle');
    Route::post('/storeReservation', [ShopController::class, 'storeReservation'])->name('storeReservation');
    Route::get('/done', [ShopController::class, 'done'])->name('done');
    Route::delete('/reservation/delete', [ShopController::class, 'deleteReservation']);
    Route::get('/mypage', [ShopController::class, 'mypage'])->name('mypage');
    Route::post('/reservation/{id}/update', [ShopController::class, 'updateReservation'])->name('reservation.update');
});
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/admin', [RegisteredUserController::class, 'admin']);
    Route::post('/createRepresentative', [RegisteredUserController::class, 'createRepresentative']);
});
Route::group(['middleware' => ['auth', 'can:representative']], function () {
    Route::get('/shop/create', [ShopController::class, 'createShop'])->name('shop.create');
    Route::post('/shop/store', [ShopController::class, 'storeShop'])->name('shop.store');
    Route::get('/shop/{id}', [ShopController::class, 'shopInfo'])->name('shop.info');
    Route::put('/shop/{id}', [ShopController::class, 'updateShop'])->name('shop.update');
    Route::get('/reservation/info', [ShopController::class, 'reservationInfo'])->name('reservation.info');
});
Route::get('/send/email', function () {
    return view('send_email');
})->middleware('auth')->name('send.email.form');
Route::post('/send/email', [EmailController::class, 'sendEmail'])
    ->middleware('auth')
    ->name('send.email');