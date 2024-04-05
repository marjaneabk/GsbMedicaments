<?php

use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\VisiteurController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/connect', function () {
    return view('vues/connect');
});

Route::get('/getLogout', [VisiteurController::class, 'signOut']);
Route::post('/login', [VisiteurController::class, 'signIn']);
Route::get('/formLogin', [VisiteurController::class, 'getLogin']);

Route::get('/formLogin', [VisiteurController::class, 'getLogin']);



Route::get('/getListeMedicaments', [MedicamentController::class, 'getMedicaments']);
Route::get('/listerMedicaments  ', [MedicamentController::class, 'getMedicaments']);

Route::get('/ajouterMedicament', [MedicamentController::class, 'addMedicament']);
Route::post('/validerMedicament', [MedicamentController::class, 'validateMedicament']);

Route::get('/modifierMedicament/{id}', [MedicamentController::class, 'updateMedicament']);
Route::post('/validerMedicament', [MedicamentController::class, 'validateMedicament']);

Route::get('/supprimerMedicament/{id}', [MedicamentController::class, 'supprimeMedicament']);

Route::get('/rechercheMedicament', [MedicamentController::class, 'rechercheMedicament']);

Route::get('/detailsMedicament/{id}', [MedicamentController::class, 'details'])->name('detailsMedicament');
Route::post('/detailsMedicament/{id}', [MedicamentController::class, 'addInteraction']);
Route::get('/supprimerInteraction/{id_medicament}/{id_interaction}', [MedicamentController::class, 'deleteInteraction']);

Route::post('/modifierMedicamentCompatible', [MedicamentController::class, 'modifierMedicamentCompatible'])->name('modifierMedicamentCompatible');
