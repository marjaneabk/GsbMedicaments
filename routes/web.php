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

Route::get('/getLogout', [VisiteurController::class, 'signOut']);
Route::post('/login', [VisiteurController::class, 'signIn']);
Route::get('/formLogin', [VisiteurController::class, 'getLogin']);

Route::get('/getListeMedicaments', [MedicamentController::class, 'getMedicaments']);
Route::get('/listerMedicaments  ', [MedicamentController::class, 'getMedicaments']);
