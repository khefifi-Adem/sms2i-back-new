<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardAcceuilController;
use App\Http\Controllers\CategorieUtilisationController;
use App\Http\Controllers\CycleFormationController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\DomaineIndusController;
use App\Http\Controllers\GroupeSms2iController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\InscriptionIndusController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\NosPartenersController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\ThemeController;

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

    Route::get('/secteurs',[SecteurController::class,'index']);

    Route::get('/domaines',[DomaineController::class,'index']);

    Route::get('/themes',[ThemeController::class,'index']);

    Route::get('/niveaux',[NiveauController::class,'index']);

    Route::get('/cycle_formations',[CycleFormationController::class,'index']);

    Route::get('/inscriptions',[InscriptionController::class,'index']);

    Route::get('/inscriptions',[InscriptionIndusController::class,'index']);

    Route::get('/card-acceuils',[CardAcceuilController::class,'index']);

    Route::post('/card-acceuils',[CardAcceuilController::class,'store']);

    Route::get('/nos_parteners',[NosPartenersController::class,'index']);

    Route::post('/nos_parteners',[NosPartenersController::class,'store']);

    Route::get('/categorie_utilisations',[CategorieUtilisationController::class,'index']);

    Route::post('/categorie_utilisations',[CategorieUtilisationController::class,'store']);

    Route::get('/marques',[MarqueController::class,'index']);

    Route::post('/marques',[MarqueController::class,'store']);

    Route::get('/articles',[ArticleController::class,'index']);

    Route::post('/articles',[ArticleController::class,'store']);

    Route::get('/domaine_indus',[DomaineIndusController::class,'index']);

    Route::post('/domaine_indus',[DomaineIndusController::class,'store']);

    Route::get('/groupe_sms2i',[GroupeSms2iController::class,'index']);

    Route::post('/groupe_sms2i',[GroupeSms2iController::class,'store']);

    Route::get('/projects',[ProjectController::class,'index']);

    Route::post('/projects',[ProjectController::class,'store']);


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

    Route::post('/cycle_formations',[CycleFormationController::class,'store']);

    Route::post('/cycle_formations/{id}',[CycleFormationController::class,'update']);

    Route::delete('cycle_formations/{id}',[CycleFormationController::class, 'destroy']);

    Route::post('/inscriptions',[InscriptionController::class,'store']);

    Route::post('/inscriptions/{id}',[InscriptionController::class,'update']);

    Route::delete('inscriptions/{id}',[InscriptionController::class, 'destroy']);

    Route::post('/inscriptionsindus',[InscriptionIndusController::class,'store']);

    Route::post('/inscriptionsindus/{id}',[InscriptionIndusController::class,'update']);

    Route::delete('inscriptionsindus/{id}',[InscriptionIndusController::class, 'destroy']);


    Route::post('/card-acceuils/{id}',[CardAcceuilController::class,'update']);

    Route::delete('/card-acceuils/{id}',[CardAcceuilController::class, 'destroy']);

    Route::post('/nos_parteners/{id}',[NosPartenersController::class,'update']);

    Route::delete('/nos_parteners/{id}',[NosPartenersController::class, 'destroy']);

    Route::post('/categorie_utilisation/{id}',[CategorieUtilisationController::class,'update']);

    Route::delete('/categorie_utilisation/{id}',[CategorieUtilisationController::class, 'destroy']);

    Route::post('/marques/{id}',[MarqueController::class,'update']);

    Route::delete('/marques/{id}',[MarqueController::class,'destroy']);

    Route::post('/articles/{id}',[ArticleController::class,'update']);

    Route::delete('/articles/{id}',[ArticleController::class,'destroy']);

    Route::post('/domaine_indus/{id}',[DomaineIndusController::class,'update']);

    Route::delete('/domaine_indus/{id}',[DomaineIndusController::class,'destroy']);

    Route::post('/groupe_sms2i/{id}',[GroupeSms2iController::class,'update']);

    Route::delete('/groupe_sms2i/{id}',[GroupeSms2iController::class,'destroy']);

    Route::post('/projects/{id}',[ProjectController::class,'update']);

    Route::delete('/projects/{id}',[ProjectController::class,'destroy']);
});
