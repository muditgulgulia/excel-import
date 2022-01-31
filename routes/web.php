<?php

use Illuminate\Support\Facades\Route;
use Sunarc\ImportExcel\Http\Controllers\ImportController;

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

Route::get('/', [ImportController::class, 'index']);
Route::post('/', [ImportController::class, 'store']);
