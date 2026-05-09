<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        
        // Share settings globally with all views
        // Share settings and categories globally with all views
        View::composer('*', function ($view) {
            $view->with('setting', \App\Models\Setting::first());
            $view->with('headerCategories', \App\Models\Category::with('children.children')
                ->whereNull('parent_id')
                ->where('status', true)
                ->orderBy('order')
                ->get());
            $view->with('footerPages', \App\Models\Page::orderBy('title')->get());
        });
    }
}
