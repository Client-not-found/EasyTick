<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\LicenseController;


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


Route::get('/', [SettingController::class, 'login'] );

Route::get('/register', [UserController::class, 'register'] );

Route::post('/save', [UserController::class, 'save'] );


Route::middleware( ['auth'] )->group( function()  {

// License Check Route
Route::get('/check', [LicenseController::class, 'check']);

Route::post('/ok', [LicenseController::class, 'save']);

//UserController Routen

Route::get('/usermanagement', [UserController::class, 'admin'] );

Route::get('/newuser', [UserController::class, 'newUser'] );

Route::get('/user/{id}', [UserController::class, 'userDetails'] );

Route::post('/home', [UserController::class, 'login'] );

Route::post('/newuser', [UserController::class, 'acpSave'] );

Route::post('/edit/{id}', [UserController::class, 'acpEdit'] );

Route::post('/delete/{id}', [UserController::class, 'acpDelete'] );

Route::get('/logout', [UserController::class, 'logout'] );

Route::post('/user', [UserController::class, 'acpSave'] );

Route::get('/profile/{id}', [UserController::class, 'profile'] );

Route::post('/profilesave/{id}', [UserController::class, 'profilesave'] );


Route::get('/security', [UserController::class, 'security'] );

//TicketController Routen
Route::get('/home', [TicketController::class, 'statistics'] );

Route::get('/tickets', [TicketController::class, 'tickets'] );

Route::get('/newticket', [TicketController::class, 'newTicket'] );

Route::get( '/ticket/{id}', [TicketController::class, 'ticketDetails']);

Route::post('/tickets', [TicketController::class, 'save'] );

Route::post('/newmessage/{id}', [TicketController::class, 'newMessage'] );

Route::post('/newstatus/{id}', [TicketController::class, 'newStatus'] );

//CategoryController Routen
Route::get('/knowledgebase', [CategoryController::class, 'showCategories'] );

Route::get('/knowledgemanagement', [CategoryController::class, 'admin'] );

Route::get('/newcategory', [CategoryController::class, 'newCategory'] );

Route::get('/category/{id}', [CategoryController::class, 'categoryDetails'] );

Route::post('/knowledgemanagement', [CategoryController::class, 'acpSave'] );

Route::post('/editCategory/{id}', [CategoryController::class, 'acpEdit'] );

Route::post('/deleteCategory/{id}', [CategoryController::class, 'acpDelete'] );

//Departement Routen
Route::get('/departement', [DepartementController::class, 'admin'] );

Route::get('/newdepartement', [DepartementController::class, 'newDepartement'] );

Route::get('/departement/{id}', [DepartementController::class, 'departementDetails'] );

Route::post('/departementmanagement', [DepartementController::class, 'acpSave'] );

Route::post('/editDepartement/{id}', [DepartementController::class, 'acpEdit'] );

Route::post('/deleteDepartement/{id}', [DepartementController::class, 'acpDelete'] );

//ArticleController Routen
Route::get('/newarticle', [ArticleController::class, 'newArticle'] );

Route::get('/article/{id}', [ArticleController::class, 'articleDetails'] );

Route::post('/knowledgebase', [ArticleController::class, 'save'] );

Route::post('/deleteArticle/{id}', [ArticleController::class, 'artDelete'] );

//DashboardController Routen
Route::get('/acp', [DashboardController::class, 'acp'] );

//SettingsController Routen
Route::get('/settings', [SettingController::class, 'acpSettings'] );

Route::post('/settingsEdit/{id}', [SettingController::class, 'save'] );

Route::post('/settingsKnowledgebase/{id}', [SettingController::class, 'saveKnowledgebase'] );

});