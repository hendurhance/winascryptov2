<?php

namespace App\Providers;

use App\BasicSetting;
use App\Menu;
use App\Page;
use App\PaymentMethod;
use App\Social;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $basic = BasicSetting::first();
        $social = Social::all();
        $menu = Menu::all();
        $pay = PaymentMethod::where('status',1)->get();
        $page = Page::first();
        View::share('site_title',$basic->title);
        View::share('basic',$basic);
        View::share('social',$social);
        View::share('menu',$menu);
        View::share('pay',$pay);
        View::share('page',$page);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
