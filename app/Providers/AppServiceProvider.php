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
            $view->with('headerCategories', \App\Models\Category::with(['children' => function($q) {
                    $q->orderBy('order', 'asc');
                }, 'children.children' => function($q) {
                    $q->orderBy('order', 'asc');
                }])
                ->whereNull('parent_id')
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->get());
            $view->with('footerPages', \App\Models\Page::all());
            $view->with('allServices', \App\Models\Service::where('status', 1)->orderBy('order', 'asc')->get());
        });
    }
}
