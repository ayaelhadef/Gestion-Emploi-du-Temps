<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
/*
 LOGIN (public)

*/
Route::get('/', function () {
    return "OK LARAVEL";
});
Route::middleware('auth')->group(function () {

    // étudiant
    Route::get('/etudiant/dashboard', [EtudiantController::class, 'dashboard']);
    Route::get('/etudiant/planning', [EtudiantController::class, 'planning']);
    Route::get('/etudiant/planning/pdf', [EtudiantController::class, 'pdf']);
    // enseignant
    Route::get('/enseignant/dashboard', [EnseignantController::class, 'dashboard']);
    Route::get('/enseignant/planning', [EnseignantController::class, 'planning']);
    Route::get('/enseignant/planning/pdf', [EnseignantController::class, 'pdf']);
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
/*
 PROTECTED ROUTES (ADMIN ONLY)
*/
Route::get('/emplois/pdf', [EmploiController::class, 'pdf']);
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/contact', [ContactController::class, 'index']);

Route::middleware(['auth', 'role:admin'])->group(function () {

 Route::get('/cours', [CoursController::class, 'index']);
    Route::post('/cours/store', [CoursController::class, 'store']);
    Route::post('/cours/update/{id}', [CoursController::class, 'update']);
    Route::get('/cours/delete/{id}', [CoursController::class, 'delete']);

   
   

    // filieres
    Route::get('/filieres', [FiliereController::class, 'index']);
    Route::post('/filieres/store', [FiliereController::class, 'store']);
Route::put('/filieres/update/{id}', [FiliereController::class, 'update']);
    //  etudiants
    Route::get('/etudiants', [UserController::class, 'etudiants']);
    Route::post('/etudiants/store', [UserController::class, 'storeEtudiant']);
    Route::post('/etudiants/update/{id}', [UserController::class, 'updateEtudiant']);

    // enseignants
    Route::get('/enseignants', [UserController::class, 'enseignants']);
    Route::post('/enseignants/store', [UserController::class, 'storeEnseignant']);
    Route::post('/enseignants/update/{id}', [UserController::class, 'updateEnseignant']);

    // delete
    Route::get('/users/delete/{id}', [UserController::class, 'delete']);

     Route::get('/salles', [SalleController::class, 'index']);
    Route::post('/salles/store', [SalleController::class, 'store']);
    Route::post('/salles/update/{id}', [SalleController::class, 'update']);
    Route::get('/salles/delete/{id}', [SalleController::class, 'delete']);
    Route::get('/admin/messages', [ContactController::class, 'messages']);
     Route::get('/emplois', [EmploiController::class, 'index']);

    Route::post('/emplois/store', [EmploiController::class, 'store']);
 //  admin sashbord
        Route::get('/admin', [AdminController::class, 'dashboard']);

        Route::get('/emplois/edit/{id}', [EmploiController::class, 'edit']);

Route::post('/emplois/update/{id}', [EmploiController::class, 'update']);

});