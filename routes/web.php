<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OikonymController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/pages/{page}', [HomeController::class, 'page']);

        Route::get('/oikonyms/', [OikonymController::class, 'index'])->name('oikonyms.index');
        Route::get('/oikonyms/on_map', [OikonymController::class, 'onMap']);
        Route::get('/oikonyms/sources', [OikonymController::class, 'sources'])->name('oikonyms.sources');
        Route::get('/oikonyms/settlements', [OikonymController::class, 'settlements'])->name('oikonyms.settlements');
        Route::get('/oikonyms/{oikonym}', [OikonymController::class, 'show'])->name('oikonyms.show');
        
        Route::get('/', [HomeController::class, 'index'])->name('welcome');


        // при переходе по неподдерживаемому пути будет выводиться главная страница сайта
        Route::fallback([HomeController::class, 'index']);
    }
);
