<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TypeTransportController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\GrapheController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use Psr\Http\Client\ClientInterface;

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

Route::get('/', [Admin::class,'index']);

// typetransport
Route::get('/typetransport',[TypeTransportController::class,'index'])->name('typetransport');
Route::get('/ajouterType',[TypeTransportController::class,'ajouter']);
Route::get('supprimerType/{id}',[TypeTransportController::class,'supprimer']);

//bus
Route::get('/bus',[BusController::class,'index'])->name('bus');
Route::get('/ajouterBus',[BusController::class,'ajouter']);
Route::get('supprimerBus/{id}',[BusController::class,'supprimer']);

//voyage
Route::get('/voyage',[VoyageController::class,'index'])->name('voyage');
Route::get('/ajouterVoyage',[VoyageController::class,'ajouter']);
Route::get('supprimerVoyage/{id}',[VoyageController::class,'supprimer']);

//Reservation
Route::get('/reservation',[ReservationController::class,'List']);
Route::get('voirReservation/{id}',[ReservationController::class,'VoirReservationClient']);
Route::get('detail/{id}',[ReservationController::class,'VoirDetailReservation']);

//Facturation
Route::get('/factureClient',[ClientController::class,'getListClientFacture']);
Route::get('detailFacture/{id}',[ClientController::class,'getDetail']);
Route::get('/salaireMembre',[MembreController::class,'getSalaire'])->name('salaire');
Route::get('/salaireMembreParType',[MembreController::class,'getSalaireParType']);

//Plainte
Route::get('/plainte',[ClientController::class,'listPlainteClients']);

//historique
Route::get('/historiqueMembre/{idtypemembre}',[MembreController::class, 'index'])->name('historiqueMembre');
Route::get('/ajouterMembre',[MembreController::class, 'ajouter']);

Route::get('/modificationMembre/{idmembre}',[MembreController::class, 'champModification']);
Route::get('/modifier',[MembreController::class, 'modifier']);

Route::get('/demissionMembre/{idmembre}',[MembreController::class, 'champDemission']);
Route::get('/demissioner', [MembreController::class, 'confirmerDemission']);
Route::get('/annulerDemission/{idmembre}',[MembreController::class, 'annulerDemission']);

Route::get('/reembaucherMembre/{idmembre}',[MembreController::class, 'champReembauche']);
Route::get('/reembaucher', [MembreController::class, 'confirmerReembauche']);

//  ------ Graphe employé ---------
Route::get('/statsMembre/{idmembre}', [GrapheController::class, 'index']);
Route::get('/grapheVoyage/{idmembre}/{mois}/{annee}', [GrapheController::class, 'grapheVoyage'])->name('grapheVoyage');

// ------- Rapports et Statistiques ---------
Route::get('/revenuMensuel', [StatsController::class, 'index']);
Route::get('/grapheRevenu/{mois}/{annee}', [StatsController::class, 'revenuMensuel']);

Route::get('/statsVehicule',[StatsController::class, 'indexVehicule']);
Route::get('/rapportVehicule/{idvehicule}', [StatsController::class, 'rapportVehicule']);
Route::get('/graphVehicule/{idvehicule}/{mois}/{annee}', [StatsController::class, 'graphVehicule']);
//Recherche
Route::get('/recherche', [ReservationController::class, 'rechercheFacture']);
