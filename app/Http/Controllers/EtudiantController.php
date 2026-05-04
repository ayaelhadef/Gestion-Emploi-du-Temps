<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\Emploi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Cours;

class EtudiantController extends Controller
{

private function formatHeure($heuresDecimal)
{
    $heures = floor($heuresDecimal);
    $minutes = round(($heuresDecimal - $heures) * 60);

    if ($minutes == 0) {
        return $heures . 'h';
    }

    return $heures . 'h' . $minutes;
}

public function pdf()
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // sécurité rôle étudiant
    if ($user->role !== 'etudiant') {
        return redirect('/');
    }

    $emplois = Emploi::with([
        'cours.filiere',
        'cours.semestre',
        'cours.enseignant',
        'salle'
    ])
    ->whereHas('cours', function ($q) use ($user) {
        $q->where('filiere_id', $user->filiere_id)
          ->where('semestre_id', $user->semestre_id);
    })
    ->get();

    $pdf = Pdf::loadView('etudiant.pdf', compact('emplois', 'user'));

    return $pdf->stream('mon-emploi.pdf');
}

public function dashboard()
{
    // validation accès
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    //  sécurité rôle étudiant
    if ($user->role !== 'etudiant') {
        return redirect('/');
    }

    $cours = Cours::where('filiere_id', $user->filiere_id)
                  ->where('semestre_id', $user->semestre_id)
                  ->get();

    $emplois = Emploi::with('cours')
        ->whereHas('cours', function ($q) use ($user) {
            $q->where('filiere_id', $user->filiere_id)
              ->where('semestre_id', $user->semestre_id);
        })
        ->get();

    $jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi'];

    $chartData = [];

    foreach ($cours as $c) {

        $dataParJour = [];

        foreach ($jours as $jour) {

            $total = $emplois->where('jour', $jour)
                ->where('cours_id', $c->id)
                ->sum(function ($e) {
                    return (strtotime($e->heure_fin) - strtotime($e->heure_debut)) / 3600;
                });

            $dataParJour[] = $this->formatHeure($total);
        }

        $chartData[] = [
            'label' => $c->nom,
            'data' => $dataParJour
        ];
    }

    $totalCours = $cours->count();
    $totalHeures = $cours->sum('nombre_heures');

    return view('etudiant.dashboard', compact(
        'cours',
        'totalCours',
        'totalHeures',
        'chartData',
        'jours'
    ));
}

public function planning()
{
    //  validation accès
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    //  sécurité rôle étudiant
    if ($user->role !== 'etudiant') {
        return redirect('/');
    }

    $emplois = Emploi::with([
        'cours.filiere',
        'cours.semestre',
        'cours.enseignant',
        'salle'
    ])
    ->whereHas('cours', function ($q) use ($user) {
        $q->where('filiere_id', $user->filiere_id)
          ->where('semestre_id', $user->semestre_id);
    })
    ->get();

    return view('etudiant.planning', compact('emplois'));
}

}