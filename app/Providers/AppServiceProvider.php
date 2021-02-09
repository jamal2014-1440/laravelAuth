<?php

namespace App\Providers;

use App\Http\Controllers\AdminController;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when([
            AdminController::class,
            AttemptToAuthenticate::class,
            RedirectIfTwoFactorAuthenticatable::class
        ])->needs(StatefulGuard::class)->give(function(){
            return Auth::guard('Admins');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
