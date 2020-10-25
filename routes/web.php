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

//menu 
Route::get('/menu', 'MenuController@showLoaisp');
Route::get('/menu/{loaisanpham_id}/{ban_id}', 'MenuController@showLoaispTable');
Route::get('/menu-sanpham/{loaisanpham_id}', 'MenuController@showMenu');

//bill product
Route::get('/cafe-select-product/{bancafe_id}/{loaisanpham_id}', 'BillController@showBill');
Route::get('/plus/{sanpham_id}/{hoadoncafe_id}', 'BillController@plusProduct');
Route::get('/minus/{sanpham_id}/{hoadoncafe_id}', 'BillController@minusProduct');
Route::get('/delete/{sanpham_id}/{hoadoncafe_id}', 'BillController@deleteProduct');
Route::get('/choose-product/{sanpham_id}/{ban_id}', 'BillController@chooseProduct');


//karaoke
Route::get('/loai-phong', 'KaraokeController@showLoaiPhong');
Route::get('/phong-karaoke/{loaiphong_id}', 'KaraokeController@showPhongKaraoke');

