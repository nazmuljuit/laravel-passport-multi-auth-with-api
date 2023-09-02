<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Student\StudentHomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group( ['prefix' => 'student','middleware' => ['auth:student','scopes:student'] ],function(){
    Route::get('/dashboard',[StudentHomeController::class, 'studentDashboard']);
    Route::post('/{student}/logout',[AuthController::class, 'userLogout']);
});