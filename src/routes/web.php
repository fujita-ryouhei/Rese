<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/get-result', [ShopController::class, 'getResult'])->name('getResult');
Route::get('/register', [RegisteredUserController::class, 'register']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [ShopController::class, 'login'])->name('login');
Route::get('/signIn', [AuthenticatedSessionController::class, 'store']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
route::get('/thanks', [ShopController::class, 'thanks']);
Route::get('/detail/{id}', [ShopController::class, 'detail'])->name('detail.page');
Route::get('/menu', [ShopController::class, 'menu']);
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/favorite/status', [ShopController::class, 'getStatus']);
    Route::post('/favorite/toggle', [ShopController::class, 'toggle'])->name('favorite.toggle');
    route::post('/storeReservation', [ShopController::class, 'storeReservation'])->name('storeReservation');
    route::get('/done', [ShopController::class, 'done'])->name('done');
    Route::get('/mypage', [ShopController::class, 'mypage']);
});
