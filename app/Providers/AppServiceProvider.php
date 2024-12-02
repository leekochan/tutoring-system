<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
//    public function boot(): void
//    {
//        if (DB::connection()->getDriverName() === 'sqlite') {
//            DB::statement('PRAGMA foreign_keys = ON');
//        }
//    }

    public function boot()
    {
        Blade::component('layouts.student-app', \App\View\Components\StudentLayout::class);
    }

}
