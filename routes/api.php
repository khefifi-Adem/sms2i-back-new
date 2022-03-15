<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CycleFormationController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\ThemeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    Route::post('/registerclient', [AuthController::class, 'registerClient']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/secteurs',[SecteurController::class,'index']);

    Route::post('/domaines',[DomaineController::class,'index']);

    Route::post('/themes',[ThemeController::class,'index']);

    Route::post('/niveaux',[NiveauController::class,'index']);

    Route::post('/cycle_formation',[CycleFormationController::class,'index']);

//Private api routes
Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/registerformateur', [AuthController::class, 'registerFormateur']);
    Route::post('/registerclientindus', [AuthController::class, 'registerIndusClient']);


    Route::post('/secteurs',[SecteurController::class,'store']);

    Route::post('/secteurs/{id}',[SecteurController::class, 'update']);

    Route::delete('secteurs/{id}',[SecteurController::class, 'destroy']);

    Route::post('/domaines',[DomaineController::class,'store']);

    Route::post('/domaines/{id}',[DomaineController::class, 'update']);

    Route::delete('domaines/{id}',[DomaineController::class, 'destroy']);

    Route::post('/themes',[ThemeController::class,'store']);

    Route::post('/themes/{id}',[ThemeController::class, 'update']);

    Route::delete('themes/{id}',[ThemeController::class, 'destroy']);

    Route::post('/niveaux',[NiveauController::class,'store']);

    Route::post('/niveaux/{id}',[NiveauController::class,'update']);

    Route::delete('niveaux/{id}',[NiveauController::class, 'destroy']);

    Route::post('/cycle_formation',[CycleFormationController::class,'store']);

    Route::post('/cycle_formation/{id}',[CycleFormationController::class,'update']);

    Route::delete('cycle_formation/{id}',[CycleFormationController::class, 'destroy']);


});
