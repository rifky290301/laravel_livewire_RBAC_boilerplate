<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
    // Blade directive for permission checks
    Blade::if('permission', function ($permission) {
      return Auth::check() && Auth::user()->hasPermission($permission);
    });

    // Blade directive for role checks
    Blade::if('role', function ($role) {
      return Auth::check() && Auth::user()->hasRole($role);
    });

    // Blade directive for any role check
    Blade::if('anyrole', function (...$roles) {
      return Auth::check() && Auth::user()->hasAnyRole($roles);
    });

    // Blade directive for all roles check
    Blade::if('allroles', function (...$roles) {
      return Auth::check() && Auth::user()->hasAllRoles($roles);
    });
  }
}
