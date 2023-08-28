<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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
//login
Route::get('/',[LoginController::class,'index'])->name('login');
Route::get('/checklogin',[LoginController::class,'check'])->name('checklogin');
//inscription
Route::get('/inscription',[LoginController::class,'voirInscription']);
Route::get('/enregistrer',[LoginController::class,'creerNewClient']);
//
Route::get('/home',[ReservationController::class,'index'])->name('home');
Route::get('destination/{id}',[ReservationController::class,'choisirDestination']);
Route::get('/voyage',[ReservationController::class,'listvoyage']);
Route::get('reservation/{idvoyage}',[ReservationController::class,'getPlace']);
Route::get('/AjoutReservation',[ReservationController::class,'Ajouter']);
Route::get('/commentaire',[ReservationController::class,'Commentaire']);
Route::get('/ecritCommentaire',[ReservationController::class,'EcritCommentaire']);
Route::get('/validationReservation',[ReservationController::class,'validation']);
Route::get('/facturation',[ReservationController::class,'afficherFacturation'])->name('facturation');
Route::get('/exportPdf',[ReservationController::class,'exportationPpdf'])->name('exportPdf');
//
Route::get('/deconnexion',[LoginController::class,'deconnexion']);
