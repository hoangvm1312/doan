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
// FORTEND
Route::get('/', 'CafeController@showKhuvuc') ;

Route::get('/login', 'HomeController@index_login');
Route::get('/logout_frontend', 'HomeController@logout');
Route::post('/frontend_dashboard', 'HomeController@dashboard');


//cafe
Route::get('/khu-vuc', 'CafeController@showKhuvuc');
Route::get('/ban-cafe/{khuvuc_id}', 'CafeController@showBancafe');

//menu cafe
Route::get('/menu', 'MenuController@showLoaisp');
Route::get('/menu/{loaisanpham_id}/{ban_id}', 'MenuController@showLoaispTable');
Route::get('/menu-sanpham/{loaisanpham_id}', 'MenuController@showMenu');

//bill product
Route::get('/cafe-select-product/{bancafe_id}/{loaisanpham_id}', 'BillController@showBill');
Route::get('/plus/{sanpham_id}/{hoadoncafe_id}', 'BillController@plusProduct');
Route::get('/minus/{sanpham_id}/{hoadoncafe_id}', 'BillController@minusProduct');
Route::get('/delete/{sanpham_id}/{hoadoncafe_id}', 'BillController@deleteProduct');
Route::get('/choose-product/{sanpham_id}/{ban_id}', 'BillController@chooseProduct');

//print cafe
Route::get('/thanh-toan-cafe/{hoadoncafe_id}', 'OrderController@print_bill_cafe');

//Công nợ cafe
Route::get('/cong-no-cafe/{hoadoncafe_id}', 'CongNoController@thongTinKhachHangCafe');
Route::post('/save-thong-tin-khach/{hoadoncafe_id}', 'CongNoController@saveCongNoCafe');



//karaoke
Route::get('/loai-phong', 'KaraokeController@showLoaiPhong');
Route::get('/phong-karaoke/{loaiphong_id}', 'KaraokeController@showPhongKaraoke');

//menu karaoke
Route::get('/menu-karaoke/{loaisanpham_id}/{ban_id}', 'MenuController@showLoaispTable_Karaoke');

//bill karaoke
Route::get('/karaoke-select-product/{phong_id}/{loaisanpham_id}', 'BillKaraokeController@showBill');
Route::get('/plus-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@plusProduct');
Route::get('/minus-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@minusProduct');
Route::get('/delete-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@deleteProduct');
Route::get('/choose-product-karaoke/{sanpham_id}/{ban_id}', 'BillKaraokeController@chooseProduct');

//print karaoke
Route::get('/check-out-karaoke/{hoadonkaraoke_id}/{phong_id}', 'BillKaraokeController@checkout');
Route::get('/thanh-toan-karaoke/{hoadonkaraoke_id}/{loaiphong_price}', 'OrderController@print_bill_karaoke');

//Công nợ karaoke
Route::get('/cong-no-karaoke/{hoadonkaraoke_id}', 'CongNoController@thongTinKhachHangkaraoke');
Route::post('/save-thong-tin-khach-karaoke/{hoadonkaraoke_id}', 'CongNoController@saveCongNokaraoke');

//THANH TOÁN CÔNG NỢ
Route::get('/tim-thong-tin-cong-no', 'CongNoController@timThongTin');
Route::post('/danh-sach-cong-no', 'CongNoController@lietKeCongNo');

Route::get('/chi-tiet-cong-no-cafe/{hoadoncafe_id}', 'CongNoController@chiTietCongNoCafe');
Route::get('/chi-tiet-cong-no-karaoke/{hoadonkaraoke_id}', 'CongNoController@chiTietCongNoKaraoke');
Route::get('/thanh-toan-cong-no-cafe/{hoadoncafe_id}', 'CongNoController@thanhToanCongNoCafe');
Route::get('/thanh-toan-cong-no-karaoke/{hoadonkaraoke_id}', 'CongNoController@thanhToanCongNoKaraoke');

//Phiếu đền bù
Route::get('/nhap-thiet-bi', 'PhieuDenBuController@nhapThietBi');
Route::post('/save-phieu-den-bu', 'PhieuDenBuController@savePhieu');
Route::get('/in-phieu-den-bu/{id}', 'PhieuDenBuController@print_phieudenbu');






//BACKEND

//backend
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/filter-by-date', 'AdminController@filter_by_date');
Route::post('/admin_dashboard', 'AdminController@dashboard');
Route::post('/dashboard-filter', 'AdminController@dashboard_filter');
Route::post('/day-order', 'AdminController@day_order');


//category
Route::get('/add_category_product', 'CategoryProduct@add_category');
Route::get('/edit_category_product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete_category_product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::get('/all_category_product', 'CategoryProduct@all_category');
Route::get('/unactive_category_product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active_category_product/{category_product_id}', 'CategoryProduct@active_category_product');


Route::post('/save_category_product', 'CategoryProduct@save_category');
Route::post('/update_category_product/{category_product_id}', 'CategoryProduct@update_category_product');

//brand product
Route::get('/add_brand_product', 'BrandProduct@add_brand_product');
Route::get('/edit_brand_product/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::get('/delete_brand_product/{brand_product_id}', 'BrandProduct@delete_brand_product');
Route::get('/all_brand_product', 'BrandProduct@all_brand_product');

Route::get('/unactive_brand_product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::get('/active_brand_product/{brand_product_id}', 'BrandProduct@active_brand_product');


Route::post('/save_brand_product', 'BrandProduct@save_brand_product');
Route::post('/update_brand_product/{brand_product_id}', 'BrandProduct@update_brand_product');

//product
Route::get('/add_product', 'ProductController@add_product');
Route::get('/edit_product/{product_id}', 'ProductController@edit_product');
Route::get('/delete_product/{product_id}', 'ProductController@delete_product');
Route::get('/all_product', 'ProductController@all_product');

Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
Route::get('/active_product/{product_id}', 'Product@active_product');


Route::post('/save_product', 'ProductController@save_product');
Route::post('/update_product/{product_id}', 'ProductController@update_product');
//khu vuc
Route::get('/add_khuvuc', 'KhuVucController@add_khuvuc');
Route::get('/edit_khuvuc/{khuvuc_id}', 'KhuVucController@edit_khuvuc');
Route::get('/delete_khuvuc/{khuvuc_id}', 'KhuVucController@delete_khuvuc');
Route::get('/all_khuvuc', 'KhuVucController@all_khuvuc');

Route::post('/save_khuvuc', 'KhuVucController@save_khuvuc');
Route::post('/update_khuvuc/{khuvuc_id}', 'KhuVucController@update_khuvuc');

//loaiphong
Route::get('/add_loaiphong', 'LoaiPhongController@add_loaiphong');
Route::get('/edit_loaiphong/{loaiphong_id}', 'LoaiPhongController@edit_loaiphong');
Route::get('/delete_loaiphong/{loaiphong_id}', 'LoaiPhongController@delete_loaiphong');
Route::get('/all_loaiphong', 'LoaiPhongController@all_loaiphong');

Route::post('/save_loaiphong', 'LoaiPhongController@save_loaiphong');
Route::post('/update_loaiphong/{loaiphong_id}', 'LoaiPhongController@update_loaiphong');

//bancafe
Route::get('/add_bancafe', 'BanCafeController@add_bancafe');
Route::get('/edit_bancafe/{bancafe_id}', 'BanCafeController@edit_bancafe');
Route::get('/delete_bancafe/{bancafe_id}', 'BanCafeController@delete_bancafe');
Route::get('/all_bancafe', 'BanCafeController@all_bancafe');

Route::get('/unactive_bancafe/{bancafe_id}', 'BanCafeController@unactive_bancafe');
Route::get('/active_bancafe/{bancafe_id}', 'BanCafeController@active_bancafe');


Route::post('/save_bancafe', 'BanCafeController@save_bancafe');
Route::post('/update_bancafe/{bancafe_id}', 'BanCafeController@update_bancafe');

//loaisanpham
Route::get('/add_loaisanpham', 'LoaiSanPhamController@add_loaisanpham');
Route::get('/edit_loaisanpham/{loaisanpham_id}', 'LoaiSanPhamController@edit_loaisanpham');
Route::get('/delete_loaisanpham/{loaisanpham_id}', 'LoaiSanPhamController@delete_loaisanpham');
Route::get('/all_loaisanpham', 'LoaiSanPhamController@all_loaisanpham');

Route::post('/save_loaisanpham', 'LoaiSanPhamController@save_loaisanpham');
Route::post('/update_loaisanpham/{loaisanpham_id}', 'LoaiSanPhamController@update_loaisanpham');

//dvt
Route::get('/add_dvt', 'DVTController@add_dvt');
Route::get('/edit_dvt/{dvt_id}', 'DVTController@edit_dvt');
Route::get('/delete_dvt/{dvt_id}', 'DVTController@delete_dvt');
Route::get('/all_dvt', 'DVTController@all_dvt');

Route::post('/save_dvt', 'DVTController@save_dvt');
Route::post('/update_dvt/{dvt_id}', 'DVTController@update_dvt');

//sanpham
Route::get('/add_sanpham', 'SanPhamController@add_sanpham');
Route::get('/edit_sanpham/{sanpham_id}', 'SanPhamController@edit_sanpham');
Route::get('/delete_sanpham/{sanpham_id}', 'SanPhamController@delete_sanpham');
Route::get('/all_sanpham', 'SanPhamController@all_sanpham');

Route::post('/save_sanpham', 'SanPhamController@save_sanpham');
Route::post('/update_sanpham/{sanpham_id}', 'SanPhamController@update_sanpham');

//phong
Route::get('/add_phong', 'PhongController@add_phong');
Route::get('/edit_phong/{phong_id}', 'PhongController@edit_phong');
Route::get('/delete_phong/{phong_id}', 'PhongController@delete_phong');
Route::get('/all_phong', 'PhongController@all_phong');

Route::get('/unactive_phong/{phong_id}', 'PhongController@unactive_phong');
Route::get('/active_phong/{phong_id}', 'PhongController@active_phong');

Route::post('/save_phong', 'PhongController@save_phong');
Route::post('/update_phong/{phong_id}', 'PhongController@update_phong');
//hoadoncafe
Route::get('/thongke_hoadoncafe', 'HoadonCafeController@thongke_hoadoncafe');
Route::get('/unactive_hoadoncafe/{hoadoncafe_id}', 'HoadonCafeController@unactive_hoadoncafe');
Route::get('/active_hoadoncafe/{hoadoncafe_id}', 'HoadonCafeController@active_hoadoncafe');
Route::get('/delete_hoadoncafe/{hoadoncafe_id}', 'HoadonCafeController@delete_hoadoncafe');
//hoadoncafedetail
Route::get('/print_hoadoncafe/{hoadoncafe_id}', 'HoaDonCafeDetailController@print_hoadoncafe');
Route::get('/show_hoadoncafedetail/{hoadoncafe_id}', 'HoadonCafeDetailController@show_hoadoncafedetail');

//phieu thue
Route::get('/thongke_phieuthue', 'PhieuThueController@thongke_phieuthue');
//phieuthuedetail
Route::get('/print_phieuthue/{phieuthue_id}', 'PhieuThueDetailController@print_phieuthue');
Route::get('/show_phieuthuedetail/{phieuthue_id}', 'PhieuThueDetailController@show_phieuthuedetail');

//nguyenlieu
Route::get('/add_nguyenlieu', 'NguyenlieuController@add_nguyenlieu');
Route::get('/edit_nguyenlieu/{nguyenlieu_id}', 'NguyenlieuController@edit_nguyenlieu');
Route::get('/delete_nguyenlieu/{nguyenlieu_id}', 'NguyenlieuController@delete_nguyenlieu');
Route::get('/all_nguyenlieu', 'NguyenlieuController@all_nguyenlieu');

Route::post('/save_nguyenlieu', 'NguyenlieuController@save_nguyenlieu');
Route::post('/update_nguyenlieu/{nguyenlieu_id}', 'NguyenlieuController@update_nguyenlieu');

//phieu nhap
Route::get('/add_phieunhap', 'PhieunhapController@add_phieunhap');
Route::get('/thongke_phieunhap', 'PhieuNhapController@thongke_phieunhap');
//phieunhapdetail
Route::get('/add_phieunhap', 'PhieunhapDetailController@add_phieunhap');
Route::post('/save_phieunhap', 'PhieunhapDetailController@save_phieunhap');
Route::get('/print_phieunhap/{phieunhap_id}', 'PhieunhapDetailController@print_phieunhap');
Route::get('/show_phieunhapdetail/{phieunhap_id}', 'PhieunhapDetailController@show_phieunhapdetail');

//phieu xuat
Route::get('/add_phieuxuat', 'PhieuXuatController@add_phieuxuat');
Route::get('/thongke_phieuxuat', 'PhieuXuatController@thongke_phieuxuat');
//phieuxuatdetail
Route::get('/add_phieuxuat', 'PhieuXuatDetailController@add_phieuxuat');
Route::post('/save_phieuxuat', 'PhieuXuatDetailController@save_phieuxuat');
Route::get('/print_phieuxuat/{phieuxuat_id}', 'PhieuXuatDetailController@print_phieuxuat');
Route::get('/show_phieuxuatdetail/{phieuxuat_id}', 'PhieuXuatDetailController@show_phieuxuatdetail');

//phieu huy
Route::get('/add_phieuhuy', 'PhieuHuyController@add_phieuhuy');
Route::get('/thongke_phieuhuy', 'PhieuHuyController@thongke_phieuhuy');
//phieuhuydetail
Route::get('/add_phieuhuy', 'PhieuHuyDetailController@add_phieuhuy');
Route::post('/save_phieuhuy', 'PhieuHuyDetailController@save_phieuhuy');
Route::get('/print_phieuhuy/{phieuhuy_id}', 'PhieuHuyDetailController@print_phieuhuy');
Route::get('/show_phieuhuydetail/{phieuhuy_id}', 'PhieuHuyDetailController@show_phieuhuydetail');
