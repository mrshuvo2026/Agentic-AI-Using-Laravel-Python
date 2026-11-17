<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // 👇 অ্যাডমিন গেট
        
            Gate::define('is-admin', function($user){
            return $user->is_admin;
        });

         // ২. শিক্ষক গেট (নতুন)
    Gate::define('is-teacher', function ($user) {
        return $user->isTeacher() || $user->isAdmin();
    });

    // ৩. কোর্স ম্যানেজ করার অনুমতি (অ্যাডমিন ও শিক্ষক)
    Gate::define('manage-courses', function ($user) {
        return $user->isAdmin() || $user->isTeacher();
    });
    
    }
}
