<?php

use App\Http\Controllers\BookedRoomController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReserveRoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RoomController;

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

//public routes
Route::get('/', [IndexController::class, 'index']);
Route::post('/reserve-room' , [ReserveRoomController::class, 'store']);
Route::get('/events', [EventController::class, 'index']);

//admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('/', [AdminController::class, 'index']);
  Route::resource('/food-items', FoodItemController::class)
    ->except(['create, edit']);
  Route::resource('/events', EventController::class)
    ->except(['create', 'edit']);
  Route::resource('/rooms', RoomController::class)
    ->except(['create', 'edit']);
  Route::resource('/reserve-rooms', ReserveRoomController::class)
    ->only(['show', 'destroy']);

  Route::post('/book-room', [BookedRoomController::class, 'storeMultiple']);
    Route::delete('/book-room', [BookedRoomController::class, 'destroyMulitple']);
  // reservations routes
  Route::get('/reservations', [NotificationController::class, 'index']);
  Route::delete('/reservations/{id}', [NotificationController::class, 'destroy']);
});

Route::get('admin/login', [AuthController::class, 'create'])
  ->name('login');
Route::post('admin/login', [AuthController::class, 'store'])
  ->name('login');
Route::delete('admin/logout', [AuthController::class, 'destroy'])
  ->name('logout');

