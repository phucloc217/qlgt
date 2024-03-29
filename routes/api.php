<?php

use App\Http\Controllers\DiemDanhController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiaoHoController;
use App\Http\Controllers\ThanhVienController;
use App\Http\Controllers\ThanhVienDiemDanhController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('thanhvien/search', [ThanhVienController::class,'search']);
Route::resource('giaoho', GiaoHoController::class);
Route::resource('thanhvien', ThanhVienController::class);
Route::resource('diemdanh', DiemDanhController::class);
Route::resource('diemdanhqr', ThanhVienDiemDanhController::class);
Route::get('dsdiemdanh', [DiemDanhController::class,'getActive']);
Route::patch('thanhvien/matkhau/{id}', [ThanhVienController::class,'updatePassword']);
Route::delete('thanhvien/{id}', [ThanhVienController::class,'destroy']);

Route::resource('user', UserController::class);
