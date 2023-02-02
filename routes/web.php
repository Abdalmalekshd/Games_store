<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Use_;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' =>  LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'games', 'namespace' => 'App\Http\Controllers\GamesControllers'], function () {
        ##### Begin Login And Signup Routes#####
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('userlogin', 'LoginController@Signin')->name('signin');

        Route::get('signup', 'SignupController@Signup')->name('signup');
        Route::post('sign', 'SignupController@sign')->name('Createaccount');

        Route::get('Account', 'ManageAccountController@ManageAccount')->name('Acc');
        Route::post('UpdateAcc','ManageAccountController@UpdateAcc')->name('UpdateAcc');



        ##### End Login And Signup Routes#####

        #####Begin Admin Routes#####

        Route::get('Dashboard', 'DashboardController@Dashboard')->name('Dashboard');

        Route::get('AddGame', 'AdminController@admin')->name('admin');

        Route::post('CreateNewGame', 'AdminController@Addgame')->name('Create_game');

        Route::get('AllGames', 'AdminController@AllGames')->name('AllGames');

        Route::get('Suggestions', 'AdminController@Suggestions')->name('Suggestions');

        Route::get('DltSuggestion/{Game_id}', 'DashboardController@Dlt')->name('DltSuggestions');



        Route::get('Edit_Game/{Game_id}','AdminController@Edit')->name('EditGame');

        Route::post('UpdateGame/{id}','AdminController@Update')->name('updategame');



        Route::get('DeleteGame/{id}','AdminController@Delete')->name('DeleteGame');


#####End Admin Routes#####

#####Begin User Routes#####
        Route::get('home', 'HomeController@home')->name('home');

        Route::get('Horror', 'HomeController@HorrorCate')->name('HorrorCate');

        Route::get('Action', 'HomeController@ActionCate')->name('ActionCate');

        Route::get('AdventureCate', 'HomeController@AdventureCate')->name('AdventureCate');

        Route::get('SurvivalCate', 'HomeController@SurvivalCate')->name('SurvivalCate');




        Route::get('fullgame/{Game_id}', 'UserController@fullgamedetails')->name('fullgame');

        Route::Post('Comment', 'UserController@Comments')->name('Comments');

        Route::get('serach', 'HomeController@serachfor')->name('serach');


        // Route::get('Download', 'UserController@Download')->name('Download');
        Route::get('Download/{link}', 'UserController@Download')->name('Download');

        // Route::get('file/download/{fileName}',[DetectionController::class,'fileDownload'])->name('file_download');









        #####End User Routes#####






        Route::get('Logout','LoginController@Logout')->name('Logout');
    });


});
