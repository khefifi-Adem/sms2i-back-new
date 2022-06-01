<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardAcceuilController;
use App\Http\Controllers\CardEtapeController;
use App\Http\Controllers\CategorieUtilisationController;
use App\Http\Controllers\CycleFormationController;
use App\Http\Controllers\CycleFormationIndusController;
use App\Http\Controllers\DemandeCycleController;
use App\Http\Controllers\DetailsFileController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\DomaineIndusController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\GroupeSms2iController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\InscriptionIndusController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\NosPartenersController;
use App\Http\Controllers\PageIntroController;
use App\Http\Controllers\ProgrammeFileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StripeController;
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


    //Auth API
    Route::post('/registerclient', [AuthController::class, 'registerClient']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/pages',[PageIntroController::class,'store']);



    //Get API
    Route::get('/secteurs',[SecteurController::class,'index']);
    Route::get('/domaines',[DomaineController::class,'index']);
    Route::get('/domainesSecteur/{id}',[DomaineController::class,'indexSecteur']);
    Route::get('/themes',[ThemeController::class,'index']);
    Route::get('/niveaux',[NiveauController::class,'index']);
    Route::get('/cycle_formations',[CycleFormationController::class,'index']);
    Route::get('/cycle_formations/{id}',[CycleFormationController::class,'show']);
    Route::get('/card-acceuils',[CardAcceuilController::class,'index']);
    Route::get('/nos_parteners',[NosPartenersController::class,'index']);
    Route::get('/categorie_utilisation',[CategorieUtilisationController::class,'index']);
    Route::get('/marques',[MarqueController::class,'index']);
    Route::get('/marques/{id}',[MarqueController::class,'show']);
    Route::get('/articles',[ArticleController::class,'index']);
    Route::get('/domaine_indus',[DomaineIndusController::class,'index']);
    Route::get('/groupe_sms2i',[GroupeSms2iController::class,'index']);
    Route::get('/projects',[ProjectController::class,'index']);
    Route::get('/pages',[PageIntroController::class,'index']);
    Route::get('/pages/{id}',[PageIntroController::class, 'show']);
    Route::get('/card-services',[CardEtapeController::class,'index']);
    Route::get('/services',[ServiceController::class,'index']);
    Route::get('/domaines_find/{id}',[DomaineController::class, 'indexDomaine']);
    Route::get('/themes_find/{id}',[ThemeController::class, 'indexTheme']);
    Route::get('/niveaux_find/{id}',[NiveauController::class, 'indexNiveau']);








//Private api routes
Route::group(['middleware' => ['auth:sanctum']],function (){
    //Auth API
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/registerformateur', [AuthController::class, 'registerFormateur']);
    Route::post('/admin', [AuthController::class, 'registerAdmin']);
    Route::post('/registerindusclient', [AuthController::class, 'registerIndusClient']);
    Route::post('/registeradmin', [AuthController::class, 'registerAdmin']);
    Route::put('/modifier_passe/{id}', [AuthController::class, 'updatePassword']);
    Route::get('/clients', [AuthController::class, 'indexClient']);
    Route::get('/clients-indus', [AuthController::class, 'indexClientIndus']);
    Route::get('/admin', [AuthController::class, 'indexAdmin']);
    Route::get('/user/{id}', [AuthController::class, 'show']);
    Route::get('/formateurs', [AuthController::class, 'indexFormateur']);


    //Inscription API
    Route::get('/inscriptionsindus',[InscriptionIndusController::class,'index']);
    Route::get('/inscriptions-cycle/{id}',[InscriptionController::class,'indexInscription']);
    Route::get('/inscriptions',[InscriptionController::class,'index']);

    //Files API
    Route::get('/files',[FilesController::class,'index']);
    Route::get('/files/{id}',[FilesController::class, 'show']);
    Route::get('/details_files',[DetailsFileController::class,'index']);
    Route::get('/details_files/{id}',[DetailsFileController::class, 'show']);
    Route::get('/programme_files',[ProgrammeFileController::class,'index']);
    Route::get('/programme_files/{id}',[ProgrammeFileController::class, 'show']);






    //Cycles API
    Route::get('/demande_cycle',[DemandeCycleController::class,'index']);
    Route::get('/demande_cycle/{id}',[DemandeCycleController::class, 'show']);
    Route::get('/cycle_indus',[CycleFormationIndusController::class,'index']);
    Route::get('/cycle_indus/{id}',[CycleFormationIndusController::class, 'show']);
    Route::get('/cycle_user/{id}',[CycleFormationIndusController::class, 'showUser']);


    //Projects API
    Route::get('/project_user/{id}',[ProjectController::class, 'showClientsProject']);



    //Delete API
    Route::delete('/card-acceuils/{id}',[CardAcceuilController::class, 'destroy']);
    Route::delete('/pages/{id}',[PageIntroController::class, 'destroy']);
    Route::delete('/card-services/{id}',[CardEtapeController::class, 'destroy']);
    Route::delete('/services/{id}',[ServiceController::class, 'destroy']);
    Route::delete('/files/{id}',[FilesController::class, 'destroy']);
    Route::delete('/details_files/{id}',[DetailsFileController::class, 'destroy']);
    Route::delete('/programme_files/{id}',[ProgrammeFileController::class, 'destroy']);
    Route::delete('/demande_cycle/{id}',[DemandeCycleController::class, 'destroy']);
    Route::delete('/cycle_indus/{id}',[CycleFormationIndusController::class, 'destroy']);
    Route::delete('/secteurs/{id}',[SecteurController::class, 'destroy']);
    Route::delete('/domaines/{id}',[DomaineController::class, 'destroy']);
    Route::delete('/themes/{id}',[ThemeController::class, 'destroy']);
    Route::delete('/niveaux/{id}',[NiveauController::class, 'destroy']);
    Route::delete('/cycle_formations/{id}',[CycleFormationController::class, 'destroy']);
    Route::delete('/inscriptions/{id}',[InscriptionController::class, 'destroy']);
    Route::delete('/inscriptionsindus/{id}',[InscriptionIndusController::class, 'destroy']);
    Route::delete('/nos_parteners/{id}',[NosPartenersController::class, 'destroy']);
    Route::delete('/categorie_utilisation/{id}',[CategorieUtilisationController::class, 'destroy']);
    Route::delete('/marques/{id}',[MarqueController::class,'destroy']);
    Route::delete('/articles/{id}',[ArticleController::class,'destroy']);
    Route::delete('/domaine_indus/{id}',[DomaineIndusController::class,'destroy']);
    Route::delete('/groupe_sms2i/{id}',[GroupeSms2iController::class,'destroy']);
    Route::delete('/projects/{id}',[ProjectController::class,'destroy']);






    //Update API
    Route::put('/card-acceuils-update/{id}',[CardAcceuilController::class,'update']);
    Route::put('/card-services-update/{id}',[CardEtapeController::class,'update']);
    Route::post('/cycle_formations/{id}',[CycleFormationController::class,'update']);
    Route::post('/pages/{id}',[PageIntroController::class, 'update']);
    Route::post('/services/{id}',[ServiceController::class,'update']);
    Route::post('/files/{id}',[FilesController::class, 'update']);
    Route::post('/details_files/{id}',[DetailsFileController::class, 'update']);
    Route::post('/programme_files/{id}',[ProgrammeFileController::class, 'update']);
    Route::post('/demande_cycle/{id}',[DemandeCycleController::class, 'update']);
    Route::post('/cycle_indus/{id}',[CycleFormationIndusController::class, 'update']);
    Route::post('/secteurs/{id}',[SecteurController::class, 'update']);
    Route::post('/domaines/{id}',[DomaineController::class, 'update']);
    Route::post('/themes/{id}',[ThemeController::class, 'update']);
    Route::post('/niveaux/{id}',[NiveauController::class,'update']);
    Route::post('/inscriptions/{id}',[InscriptionController::class,'update']);
    Route::post('/inscriptionsindus/{id}',[InscriptionIndusController::class,'update']);
    Route::post('/nos_parteners/{id}',[NosPartenersController::class,'update']);
    Route::post('/categorie_utilisation/{id}',[CategorieUtilisationController::class,'update']);
    Route::post('/marques/{id}',[MarqueController::class,'update']);
    Route::post('/articles/{id}',[ArticleController::class,'update']);
    Route::post('/domaine_indus/{id}',[DomaineIndusController::class,'update']);
    Route::post('/groupe_sms2i/{id}',[GroupeSms2iController::class,'update']);
    Route::post('/projects/{id}',[ProjectController::class,'update']);






    //Store API
    Route::post('/card-acceuils',[CardAcceuilController::class,'store']);
    Route::post('/nos_parteners',[NosPartenersController::class,'store']);
    Route::post('/categorie_utilisation',[CategorieUtilisationController::class,'store']);
    Route::post('/marques',[MarqueController::class,'store']);
    Route::post('/articles',[ArticleController::class,'store']);
    Route::post('/domaine_indus',[DomaineIndusController::class,'store']);
    Route::post('/groupe_sms2i',[GroupeSms2iController::class,'store']);
    Route::post('/projects',[ProjectController::class,'store']);
    Route::post('/card-services',[CardEtapeController::class,'store']);
    Route::post('/services',[ServiceController::class,'store']);
    Route::post('/files',[FilesController::class,'store']);
    Route::post('/files-indus',[FilesController::class,'storeIndus']);
    Route::post('/details_files',[DetailsFileController::class,'storeCycle']);
    Route::post('/details_files_indus',[DetailsFileController::class,'storeIndus']);
    Route::post('/programme_files',[ProgrammeFileController::class,'storeCycle']);
    Route::post('/programme_files_indus',[ProgrammeFileController::class,'storeIndus']);
    Route::post('/demande_cycle',[DemandeCycleController::class,'store']);
    Route::post('/cycle_indus',[CycleFormationIndusController::class,'store']);
    Route::post('/secteurs',[SecteurController::class,'store']);
    Route::post('/domaines',[DomaineController::class,'store']);
    Route::post('/themes',[ThemeController::class,'store']);
    Route::post('/niveaux',[NiveauController::class,'store']);
    Route::post('/cycle_formations',[CycleFormationController::class,'store']);
    Route::post('/inscriptions',[InscriptionController::class,'store']);
    Route::post('/inscriptionsindus',[InscriptionIndusController::class,'store']);

});
