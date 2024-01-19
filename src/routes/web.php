<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

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

Route::get('/', [ShopController::class, 'index']);
Route::get('/register', [ShopController::class, 'register']);
Route::get('/login', [ShopController::class, 'login']);
route::get('/thanks', [ShopController::class, 'thanks']);
route::get('/done', [ShopController::class, 'done']);
Route::get('/menu1', [ShopController::class, 'menu1']);
Route::get('/menu2', [ShopController::class, 'menu2']);
Route::get('/mypage', [ShopController::class, 'mypage']);