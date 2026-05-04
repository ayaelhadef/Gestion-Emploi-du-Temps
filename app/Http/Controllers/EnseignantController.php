<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cours;
use App\Models\Emploi;

class EnseignantController extends Controller
{
    public function dashboard()
    {
        // VALIDATION 
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        //  sécurité rôle enseignant
        if ($user->role !== 'enseignant') {
            return redirect('/');
        }

        $emplois = Emploi::with([
            'cours.filiere',
            'cours.semestre',
            'salle'
        ])
        ->whereHas('cours', function($q) use ($user){
            $q->where('enseignant_id', $user->id);
        })
        ->orderBy('jour')
        ->orderBy('heure_debut')
        ->get();

        $totalCours = $emplois->count();

        $totalHeures = $emplois->sum(function ($e) {
            return (strtotime($e->heure_fin) - strtotime($e->heure_debut)) / 3600;
        });

        return view('enseignant.dashboard', compact(
            'emplois',
            'totalCours',
            'totalHeures'
        ));
    }
}