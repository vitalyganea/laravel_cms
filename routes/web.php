<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TablesController;

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


Route::prefix('/admin')->group(function () {
    Route::get('/', [TablesController::class, 'getMenu']);
    Route::get('/table/{id}', [TablesController::class, 'getTable']);
    Route::get('/create/{id}', [TablesController::class, 'getColumns']);
    Route::post('/create/{id}', [TablesController::class, 'createObject']);
    Route::post('/deleteElement', [TablesController::class, 'deleteElement']);
});

Route::get('/', function () {
    return view('welcome');
});
