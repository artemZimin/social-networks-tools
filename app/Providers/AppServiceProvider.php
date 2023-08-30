<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\AuthAction;
use App\Actions\EmailVerifyAction;
use App\Actions\SendVerificationLinkAction;
use App\Actions\ShowUserAction;
use App\Actions\UserRegisterAction;
use App\Contracts\Actions\AuthActionContract;
use App\Contracts\Actions\EmailVerifyActionContract;
use App\Contracts\Actions\SendVerificationLinkActionContract;
use App\Contracts\Actions\ShowUserActionContract;
use App\Contracts\Actions\UserRegisterActionContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRegisterActionContract::class, UserRegisterAction::class);
        $this->app->bind(AuthActionContract::class, AuthAction::class);
        $this->app->bind(EmailVerifyActionContract::class, EmailVerifyAction::class);
        $this->app->bind(SendVerificationLinkActionContract::class, SendVerificationLinkAction::class);
        $this->app->bind(ShowUserActionContract::class, ShowUserAction::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
