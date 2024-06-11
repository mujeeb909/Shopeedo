<?php

namespace MyFatoorah\LaravelPackage;

use App\Http\Controllers\MyFatoorahController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MyFatoorahServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->publishes([
            __DIR__ . '/../config/myfatoorah.php'             => config_path('myfatoorah.php'),
            __DIR__ . '/../resources/views'                   => resource_path('views/myfatoorah'),
            __DIR__ . '/../public'                            => public_path('vendor/myfatoorah'),
            __DIR__ . '/../lang'                              => lang_path(),
            __DIR__ . '/controllers/MyFatoorahController.php' => app_path() . '/Http/Controllers/MyFatoorahController.php',
                ], 'myfatoorah');

        Route::get('myfatoorah', [
            'as'   => 'myfatoorah', 'uses' => MyFatoorahController::class . '@index'
        ]);

        Route::get('myfatoorah/callback', [
            'as'   => 'myfatoorah.callback', 'uses' => MyFatoorahController::class . '@callback'
        ]);

        Route::get('myfatoorah/checkout', [
            'as'   => 'myfatoorah.cardView', 'uses' => MyFatoorahController::class . '@checkout'
        ]);

        Route::post('myfatoorah/webhook', [
            'as'   => 'myfatoorah.webhook', 'uses' => MyFatoorahController::class . '@webhook'
        ]);

        defined('MYFATOORAH_LARAVEL_PACKAGE_VERSION') or define('MYFATOORAH_LARAVEL_PACKAGE_VERSION', '2.2.4');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->mergeConfigFrom(
                __DIR__ . '/../config/myfatoorah.php', 'myfatoorah'
        );
    }
}
