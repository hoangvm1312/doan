<?php

namespace App\Providers;
use App\Phong;
use App\SanPham;
use App\BanCafe;
use App\NguyenLieu;
use App\KhuVuc;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
        $phong = Phong::all()->count();
        $khuvuc = KhuVuc::all()->count();
        $sanpham = SanPham::all()->count();
        $ban = BanCafe::all()->count();
        $nguyenlieu = NguyenLieu::all()->count();
        $view->with('phong',$phong)->with('khuvuc',$khuvuc)->with('sanpham',$sanpham)->with('ban',$ban)->with('nguyenlieu',$nguyenlieu);
        });
    }
}
