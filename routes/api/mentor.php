<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Mentor\MentorHomeController;

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


Route::group( ['prefix' => 'mentor','middleware' => ['auth:mentor','scopes:mentor'] ],function(){
    Route::get('/dashboard',[MentorHomeController::class, 'mentorDashboard']);
    Route::post('/{mentor}/logout',[AuthController::class, 'userLogout']);
});

