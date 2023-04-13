<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
  return 'hello';
});

Route::prefix('/admin')->group( function () {
  
  Route::get('/', [AdminController::class, 'index']);
  Route::resource('/food-items', FoodItemController::class)
    ->except(['create, edit']);

});