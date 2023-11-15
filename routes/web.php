<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| CLEAR
|--------------------------------------------------------------------------
|
 */

Route::get('/app-clear', function () {

    $cacheClear = Artisan::call('cache:clear');
    echo "Application cache cleared! <br/>";
    $clearCompiled = Artisan::call('clear-compiled');
    echo "Compiled services and packages files removed! <br/>";
    $routeClear = Artisan::call('route:clear');
    echo "Route cache cleared! <br/>";
    $viewClear = Artisan::call('view:clear');
    echo "Compiled views cleared! <br/>";
    $configClear = Artisan::call('config:clear');
    echo "Configuration cache cleared! <br/>";
    $configCache = Artisan::call('config:cache');
    echo "Configuration cache cleared! <br/>";
    echo "Configuration cached successfully! <br/><br/>";

    echo 'App cleared!';
});
