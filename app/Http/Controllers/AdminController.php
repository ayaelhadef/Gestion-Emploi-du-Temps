<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cours;
use App\Models\Salle;
use App\Models\Emploi;
use App\Models\Filiere;
use App\Models\Semestre;

class AdminController extends Controller
{
    public function dashboard()
    {
        // statistiques 

        $etudiants = User::where('role', 'etudiant')->count();

        $enseignants = User::where('role', 'enseignant')->count();

        $cours = Cours::count();

        $salles = Salle::count();
        $filieresCount = Filiere::count(); 


        // ===== emplois filière semestre =====

        $emplois = [];

        $filieres = Filiere::all();
        $semestres = Semestre::all();

        foreach($filieres as $f)
        {
            foreach($semestres as $s)
            {
                // vérifier si emploi existe
                $existe = Emploi::whereHas('cours', function($q) use ($f, $s){

                    $q->where('filiere_id', $f->id)
                      ->where('semestre_id', $s->id);

                })->exists();

                $emplois[] = [

                    'filiere_id' => $f->id,
                    'semestre_id' => $s->id,

                    'filiere' => $f->nom,
                    'semestre' => $s->nom,

                    'existe' => $existe
                ];
            }
        }

        // ===== derniers cours ajoutés =====

        $dernierEmplois = Emploi::with([
            'cours.filiere',
            'cours.semestre',
            'cours.enseignant',
            'salle'
        ])
        ->latest()
        ->take(10)
        ->get();

        return view('admin.dashboard', compact(
    'etudiants',
    'enseignants',
    'cours',
    'salles',
    'filieresCount', 
    'emplois',
    'dernierEmplois'
));
    }
}