<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Emploi;
use App\Models\Cours;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\Salle;
use App\Models\User;

class EmploiController extends Controller
{
    //  afficher page
    public function index(Request $request)
    {
        $filieres = Filiere::all();
        $semestres = Semestre::all();
        $salles = Salle::all();

        $enseignants = User::where('role', 'enseignant')->get();

        $cours = Cours::with('enseignant');

        if ($request->filiere_id) {
            $cours->where('filiere_id', $request->filiere_id);
        }

        if ($request->semestre_id) {
            $cours->where('semestre_id', $request->semestre_id);
        }

        $cours = $cours->get();

        $emplois = Emploi::with([
            'cours.filiere',
            'cours.semestre',
            'cours.enseignant',
            'salle'
        ]);

        if ($request->filiere_id) {
            $emplois->whereHas('cours', function ($q) use ($request) {
                $q->where('filiere_id', $request->filiere_id);
            });
        }

        if ($request->semestre_id) {
            $emplois->whereHas('cours', function ($q) use ($request) {
                $q->where('semestre_id', $request->semestre_id);
            });
        }

        $emplois = $emplois->get();

        return view('emplois.index', compact(
            'filieres',
            'semestres',
            'salles',
            'cours',
            'emplois',
            'enseignants'
        ));
    }

    //  UPDATE

    public function update(Request $request, $id)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'salle_id' => 'required',
            'jour' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'enseignant_id' => 'required'
        ]);

        $emploi = Emploi::findOrFail($id);

        // vérif salle
        $existe = Emploi::where('salle_id', $request->salle_id)
            ->where('jour', $request->jour)
            ->where('id', '!=', $id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                  ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin]);
            })
            ->exists();

        if ($existe) {
            return back()->with('error', 'Salle déjà occupée');
        }

        $emploi->update([
            'salle_id' => $request->salle_id,
            'jour' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        $emploi->cours->update([
            'enseignant_id' => $request->enseignant_id
        ]);

        return back()->with('success', 'Emploi modifié avec succès');
    }

    public function pdf(Request $request)
    {
        $filieres = Filiere::all();
        $semestres = Semestre::all();

        $emplois = Emploi::with([
            'cours.filiere',
            'cours.semestre',
            'cours.enseignant',
            'salle'
        ]);

        if ($request->filiere_id) {
            $emplois->whereHas('cours', function ($q) use ($request) {
                $q->where('filiere_id', $request->filiere_id);
            });
        }

        if ($request->semestre_id) {
            $emplois->whereHas('cours', function ($q) use ($request) {
                $q->where('semestre_id', $request->semestre_id);
            });
        }

        $emplois = $emplois->get();

        $pdf = Pdf::loadView('emplois.pdf', [
            'emplois' => $emplois,
            'filieres' => $filieres,
            'semestres' => $semestres
        ]);

        return $pdf->stream('emploi-du-temps.pdf'); 
    }

    // ajouter emploi
    public function store(Request $request)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'cours_id' => 'required',
            'salle_id' => 'required',
            'jour' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required'
        ]);

        //  verifier salle occupée
        $existe = Emploi::where('salle_id', $request->salle_id)
            ->where('jour', $request->jour)
            ->where(function ($q) use ($request) {

                $q->whereBetween('heure_debut', [
                    $request->heure_debut,
                    $request->heure_fin
                ])
                ->orWhereBetween('heure_fin', [
                    $request->heure_debut,
                    $request->heure_fin
                ]);

            })
            ->exists();

        if ($existe) {
            return back()->with(
                'error',
                'Salle déjà occupée à ce moment-là'
            );
        }

        Emploi::create([
            'cours_id' => $request->cours_id,
            'salle_id' => $request->salle_id,
            'jour' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        return back()->with('success', 'Emploi ajouté');
    }
}