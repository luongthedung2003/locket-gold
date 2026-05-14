<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $activities = Activity::where('user_id', Auth::id())
                    ->latest()
                    ->take(5)
                    ->get();
                $view->with('userActivities', $activities);
            }
        });
    }
}
