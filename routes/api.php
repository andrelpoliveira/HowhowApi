<?php

use App\Http\Controllers\Api\Web\Authentication\LoginController;
use App\Http\Controllers\Api\Web\Authentication\RegisterController;

use App\Http\Controllers\Api\Web\User\UserController;

use App\Http\Controllers\Api\Web\Campaign\CampaignController;
use App\Http\Controllers\Api\Web\Campaign\CampaignParticipantsController;
use App\Http\Controllers\Api\Web\Categories\CategoriesController;
use App\Http\Controllers\Api\Web\Categories\LineOfBusinessController;
use App\Http\Controllers\StatesController;
use App\Models\CampaignParticipants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



//não tem login, aceita login de todos os tipos de usuarios
Route::post('/login' , [LoginController::class, 'login']);


Route::get('/categories', [CategoriesController::class, 'getAllCategories']);
Route::get('/lineOfBusiness', [LineOfBusinessController::class, 'getAllLines']);
Route::get('/getStates' , [StatesController::class, 'getStates']);
/*
Rotas que cuidam do registro do usuario
todas começam com o prefixo de /register
*/
Route::group(['prefix' => 'register'], function() {

    Route::post('/influencer', [RegisterController::class, 'registerInfluencer']);

    Route::post('/brand', [RegisterController::class, 'registerBrand']);    

    Route::post('/agency', [RegisterController::class, 'registerAgency']);

});


/*
Rotas aonde precisa estar autenticado para 
que se obtenha uma resposta da api

*/
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/getSelf', [UserController::class, 'getSelf']);

    //finalização do cadastro do influencer
    Route::post('/influencer/wrapUp', [UserController::class , 'wrapUpRegisterInfluencer']);

    Route::group(['prefix' => 'profile'],function(){
        Route::get('/seeOwnProfile', [UserController::class, 'getProfile']);
    });


    //rotas de update para cada tipo de role
    Route::group(['prefix'=> 'userUpdate'], function()
    {
        Route::patch('/influencer',     [UserController::class , 'updateInfluencer']);
        Route::patch('/brand',          [UserController::class , 'updateBrand']);
        Route::patch('/agency',         [UserController::class , 'updateAgency']);
    });
    
    Route::group(['prefix' => 'campaign'], function()
    {
        
        //retorna todas as campanhas
        Route::get('/index',        [CampaignController::class , 'index']);

        //cria o registo da campanha
        Route::post('/create',      [CampaignController::class , 'store']);

        //mostra campanha expecifica 
        Route::get('/show',         [CampaignController::class , 'show']);

        //update de campanha
        Route::post('/update',       [CampaignController::class , 'update']);

        //Deleta a campanha
        //trocar isso por um encerrar campanha
        Route::delete('/endcampaign',   [CampaignController::class, 'endcampaign']);

        //Influenciador pede para entrar na campanha
        Route::post('/join',        [CampaignParticipants::class, 'joinCampaign']);

        //Muda o estado de confirmação do influenciador 
        Route::patch('/changeConfirmaitonStatus',[CampaignParticipants::class, 'changeInfluencerConfirmationStatus']);

    });

    Route::group(['prefix' => 'brand'], function()
    {
        Route::get('/getInfluencers',   [UserController::class, 'getInfluencers']);
    });
    //Muda o estado de confirmação do influenciador 
    Route::patch('/changeConfirmaitonStatus',[CampaignParticipants::class, 'changeInfluencerConfirmationStatus']);

    //Pega aonde o influenciador está participando e retorna todas as campanhas e seu status de confirmação
    Route::get('/getParticipations', [CampaignParticipants::class, 'whereInfluencerParticipate']);
    
    

    Route::post ('/logout' , [LoginController::class, 'logout']);
});