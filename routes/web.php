<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\courrierEntrant;
use App\Http\Controllers\courrierSortants;
use App\Http\Controllers\DashboardController;

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
// dashboard
Route::get('/dashboard',[DashboardController::class,'showDashboard']);
Route::view('/archives','archives')->name('archives');
//courriers_entrants
Route::get('/courrierEntrant',[courrierEntrant::class,'show'])->name('courrierEntrant');
Route::post('/SearchCourrier',[courrierEntrant::class,'search'])->name('courrier.search');
Route::view('ajouter','entrant.ajouterCourrier');
Route::match(['post','get'],'/modifier/{x}',[courrierEntrant::class,'showToUpdateData']);
Route::post('/ajout',[courrierEntrant::class,'insertData']);
Route::post('/saveData/{id}', [courrierEntrant::class, 'saveUpdatedData']);
Route::get('/voir/{id}', [courrierEntrant::class, 'showCourrier']);
Route::delete('/supprimer_Entrant/{id}', [courrierEntrant::class, 'deleteIncoming'])->name('delete-Incoming');

// Archives_entrants
Route::get('archivesEntrants',[courrierEntrant::class,'showArchive'])->name('archivesEntrants');
Route::get('/archiverEntrant/{id}',[courrierEntrant::class,'archiveEnt']);
Route::delete('/supprArchiveEnt/{id}', [courrierEntrant::class,'deleteArchiveEnt'])->name('supprArchiveEnt');
Route::get('/voirArchiveEnt/{id}', [courrierEntrant::class, 'voirArchiveEnt']);
Route::match(['post','get'],'/modifierArchiveEnt/{x}',[courrierEntrant::class,'modifierArchiveEnt']);
Route::post('/saveArchiveEntrant/{id}', [courrierEntrant::class, 'saveArchiveEntrant']);


// Courriers sortants
Route::get('/courrierSortant', [courrierSortants::class, 'showSortant'])->name('courrierSortant');
Route::view('/AddSortant', 'sortant.ajouterCourrierSortant');
Route::match(['post','get'], '/modifier-sortant/{x}', [courrierSortants::class, 'showToUpdateData']);
Route::post('/ajoutSortant', [courrierSortants::class, 'insertDataSortant']);
Route::post('/saveData-sortant/{id}', [courrierSortants::class, 'saveUpdatedData']);
Route::delete('/supprimer_Sortants/{id}', [courrierSortants::class, 'deleteOutgoing'])->name('delete-Outgoing');
Route::get('/voir-sortant/{id}', [courrierSortants::class, 'showCourrier']);

// Archives_sortant
Route::get('archivesSortant',[courrierSortants::class,'showArchive'])->name('archivesSortant');
Route::get('/archiverSortant/{id}',[courrierSortants::class,'archiveSort']);
Route::delete('/supprArchiveSort/{id}', [courrierSortants::class, 'deleteArchiveSort'])->name('supprArchiveSort');
Route::get('/voirArchiveSort/{id}', [courrierSortants::class, 'voirArchiveSort']);
Route::match(['post','get'], '/modifierArchiveSort/{x}', [courrierSortants::class, 'modifierArchiveSort']);
Route::post('/saveArchiveSortant/{id}', [courrierSortants::class, 'saveArchiveSortant']);


