<?php

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

Route::get('/', 'CafeController@showKhuvuc') ;

//cafe
Route::get('/khu-vuc', 'CafeController@showKhuvuc');
Route::get('/ban-cafe/{khuvuc_id}', 'CafeController@showBancafe');

//karaoke
Route::get('/loai-phong', 'KaraokeController@showLoaiPhong');
Route::get('/phong-karaoke/{loaiphong_id}', 'KaraokeController@showPhongKaraoke');
