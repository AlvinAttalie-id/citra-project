<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::auth(function () {
                $user = Auth::user();

                // hanya izinkan role 'admin'
                return $user && $user->hasRole('admin');
            });
        });
    }
}
