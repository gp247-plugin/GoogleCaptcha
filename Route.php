<?php
use Illuminate\Support\Facades\Route;

$config = file_get_contents(__DIR__.'/gp247.json');
$config = json_decode($config, true);

if(gp247_extension_check_active($config['configGroup'], $config['configKey'])) {


    Route::group(
    [
        'middleware' => GP247_FRONT_MIDDLEWARE,
        'prefix'    => 'plugin/googlecaptcha',
        'namespace' => 'App\GP247\Plugins\GoogleCaptcha\Controllers',
    ],
    function () {
        Route::get('index', 'FrontController@index')
        ->name('googlecaptcha.index');
    }
);

    Route::group(
        [
            'prefix' => GP247_ADMIN_PREFIX.'/googlecaptcha',
            'middleware' => GP247_ADMIN_MIDDLEWARE,
        ],
        function () {
            Route::get('/', \App\GP247\Plugins\GoogleCaptcha\Livewire\AdminLivewire::class)
            ->name('admin_googlecaptcha.index');
        }
    );
}