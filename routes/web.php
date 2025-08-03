<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TableauController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\EmploidutempsController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DevoirController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UtilisateurController;

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

// ROUTES DE L APPLICATION


//MENU TABLEAU DE BORD 
// Tableau de bord
    Route::get('/dashboard', [TableauController::class, 'index'])->name('dashboard');

//MENU INSCRIPTIONS
    // Inscriptions


    Route::get('/inscriptions/index', [InscriptionController::class, 'index'])->name('inscriptions_index');
Route::get('/inscriptions/liste', [InscriptionController::class, 'liste'])->name('inscriptions_liste');
Route::get('/inscriptions/modifier/{id}', [InscriptionController::class, 'show'])->name('inscriptions_edit');
Route::post('/inscriptions/update/{id}', [InscriptionController::class, 'update'])->name('inscriptions_update');
Route::post('/inscriptions/delete/{id}', [InscriptionController::class, 'destroy'])->name('inscriptions_delete');

//Parents



Route::get('/parents/index', [ParentController::class, 'index'])->name('parents_index');
Route::get('/parents/liste', [ParentController::class, 'liste'])->name('parents_liste');
Route::get('/parents/modifier/{id}', [ParentController::class, 'show'])->name('parents_edit');
Route::post('/parents/update/{id}', [ParentController::class, 'update'])->name('parents_update');
Route::post('/parents/delete/{id}', [ParentController::class, 'destroy'])->name('parents_delete');

    Route::get('/parents/liaisons/parents-eleves', [ParentController::class, 'afficheLiaison'])->name('liaisons.index');
    Route::post('/parents/liaisons/parents-eleves', [ParentController::class, 'validerLiaison'])->name('liaisons.store');

//MENU PERSONNEL 

// Enseignants



    Route::get('/enseignants/index', [EnseignantController::class, 'index'])->name('enseignants_index');
Route::get('/enseignants/liste', [EnseignantController::class, 'liste'])->name('enseignants_liste');
Route::get('/enseignants/modifier/{id}', [EnseignantController::class, 'show'])->name('enseignants_edit');
Route::post('/enseignants/update/{id}', [EnseignantController::class, 'update'])->name('enseignants_update');
Route::post('/enseignants/delete/{id}', [EnseignantController::class, 'destroy'])->name('enseignants_delete');

//MENU SCOLARITE 

    // Classes

    Route::get('/classes/index', [ClasseController::class, 'index'])->name('classes_index');
Route::get('/classes/liste', [ClasseController::class, 'liste'])->name('classes_liste');
Route::get('/classes/modifier/{id}', [ClasseController::class, 'show'])->name('classes_edit');
Route::post('/classes/update/{id}', [ClasseController::class, 'update'])->name('classes_update');
Route::post('/classes/delete/{id}', [ClasseController::class, 'destroy'])->name('classes_delete');



// Niveau


 Route::get('/niveaux/index', [NiveauController::class, 'index'])->name('niveaux_index');
Route::get('/niveaux/liste', [NiveauController::class, 'liste'])->name('niveaux_liste');
Route::get('/niveaux/modifier/{id}', [NiveauController::class, 'show'])->name('niveaux_edit');
Route::post('/niveaux/update/{id}', [NiveauController::class, 'update'])->name('niveaux_update');
Route::post('/niveaux/delete/{id}', [NiveauController::class, 'destroy'])->name('niveaux_delete');



// Cycles

Route::get('/cycles/index', [CycleController::class, 'index'])->name('cycles_index');
Route::get('/cycles/liste', [CycleController::class, 'liste'])->name('cycles_liste');
Route::get('/cycles/modifier/{id}', [CycleController::class, 'show'])->name('cycles_edit');
Route::post('/cycles/update/{id}', [CycleController::class, 'update'])->name('cycles_update');
Route::post('/cycles/delete/{id}', [CycleController::class, 'destroy'])->name('cycles_delete');

// Matieres

Route::get('/matieres/index', [MatiereController::class, 'index'])->name('matieres_index');
Route::get('/matieres/liste', [MatiereController::class, 'liste'])->name('matieres_liste');
Route::get('/matieres/modifier/{id}', [MatiereController::class, 'show'])->name('matieres_edit');
Route::post('/matieres/update/{id}', [MatiereController::class, 'update'])->name('matieres_update');
Route::post('/matieres/delete/{id}', [MatiereController::class, 'destroy'])->name('matieres_delete');
;



//MENU PEDAGOGIE
    // Emploi du temps

Route::get('/emploidutemps/index', [EmploidutempsController::class, 'index'])->name('emploidutemps_index');
Route::get('/emploidutemps/liste', [EmploidutempsController::class, 'liste'])->name('emploidutemps_liste');
Route::get('/emploidutemps/modifier/{id}', [EmploidutempsController::class, 'show'])->name('emploidutemps_edit');
Route::post('/emploidutemps/update/{id}', [EmploidutempsController::class, 'update'])->name('emploidutemps_update');
Route::post('/emploidutemps/delete/{id}', [EmploidutempsController::class, 'destroy'])->name('emploidutemps_delete');

    // Absences

Route::get('/absences/index', [AbsenceController::class, 'index'])->name('absences_index');
Route::get('/absences/liste', [AbsenceController::class, 'liste'])->name('absences_liste');
Route::get('/absences/modifier/{id}', [AbsenceController::class, 'show'])->name('absences_edit');
Route::post('/absences/update/{id}', [AbsenceController::class, 'update'])->name('absences_update');
Route::post('/absences/delete/{id}', [AbsenceController::class, 'destroy'])->name('absences_delete');



    // Notes

Route::get('/notes/index', [NoteController::class, 'index'])->name('notes_index');
Route::get('/notes/liste', [NoteController::class, 'liste'])->name('notes_liste');
Route::get('/notes/modifier/{id}', [NoteController::class, 'show'])->name('notes_edit');
Route::post('/notes/update/{id}', [NoteController::class, 'update'])->name('notes_update');
Route::post('/notes/delete/{id}', [NoteController::class, 'destroy'])->name('notes_delete');


    // Devoirs
    Route::get('/devoirs/index', [DevoirController::class, 'index'])->name('devoirs_index');
Route::get('/devoirs/liste', [DevoirController::class, 'liste'])->name('devoirs_liste');
Route::get('/devoirs/modifier/{id}', [DevoirController::class, 'show'])->name('devoirs_edit');
Route::post('/devoirs/update/{id}', [DevoirController::class, 'update'])->name('devoirs_update');
Route::post('/devoirs/delete/{id}', [DevoirController::class, 'destroy'])->name('devoirs_delete');


//MENU COMMUNICATION 
    // Messages
    Route::get('/messages/index', [MessageController::class, 'index'])->name('messages_index');
Route::get('/messages/liste', [MessageController::class, 'liste'])->name('messages_liste');
Route::get('/messages/modifier/{id}', [MessageController::class, 'show'])->name('messages_edit');
Route::post('/messages/update/{id}', [MessageController::class, 'update'])->name('messages_update');
Route::post('/messages/delete/{id}', [MessageController::class, 'destroy'])->name('messages_delete');

    

//MENU ADMINISTRATION 
// Utilisateurs
    Route::get('/utilisateurs/index', [UtilisateurController::class, 'index'])->name('utilisateurs_index');
Route::get('/utilisateurs/liste', [UtilisateurController::class, 'liste'])->name('utilisateurs_liste');
Route::get('/utilisateurs/modifier/{id}', [UtilisateurController::class, 'show'])->name('utilisateurs_edit');
Route::post('/utilisateurs/update/{id}', [UtilisateurController::class, 'update'])->name('utilisateurs_update');
Route::post('/utilisateurs/delete/{id}', [UtilisateurController::class, 'destroy'])->name('utilisateurs_delete');


//Roles

    Route::get('/roles/index', [RoleController::class, 'index'])->name('roles_index');
Route::get('/roles/liste', [RoleController::class, 'liste'])->name('roles_liste');
Route::get('/roles/modifier/{id}', [RoleController::class, 'show'])->name('roles_edit');
Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles_update');
Route::post('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles_delete');





