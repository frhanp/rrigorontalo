<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menyediakan data ke layout publik setiap kali dirender
        View::composer('layouts.public', function ($view) {
            $view->with('nav_categories', Category::orderBy('name', 'asc')->get());
        });
    }
}
