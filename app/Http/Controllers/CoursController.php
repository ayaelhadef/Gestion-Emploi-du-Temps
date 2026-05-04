<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\User;

class CoursController extends Controller
{
    //  afficher cours
    public function index(Request $request)
    {
        $filieres = Filiere::all();
        $semestres = Semestre::all();
        $enseignants = User::where('role', 'enseignant')->get();

        $cours = Cours::with(['filiere', 'semestre', 'enseignant']);

       
        if ($request->filiere_id) {
            $cours->where('filiere_id', $request->filiere_id);
        }

        
        if ($request->semestre_id) {
            $cours->where('semestre_id', $request->semestre_id);
        }

        $cours = $cours->get();

        return view('cours.index', compact(
            'cours',
            'filieres',
            'semestres',
            'enseignants'
        ));
    }

    // ajouter cours
    public function store(Request $request)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required',
            'semestre_id' => 'required',
            'enseignant_id' => 'required',
            'nombre_heures' => 'required|numeric|min:1'
        ]);

        Cours::create([
            'nom' => $request->nom,
            'filiere_id' => $request->filiere_id,
            'semestre_id' => $request->semestre_id,
            'enseignant_id' => $request->enseignant_id,
            'nombre_heures' => $request->nombre_heures,
        ]);

        return redirect('/cours');
    }

    //  update cours
    public function update(Request $request, $id)
    {
        //  VALIDATION AJOUT
        $request->validate([
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required',
            'semestre_id' => 'required',
            'enseignant_id' => 'required',
            'nombre_heures' => 'required|numeric|min:1'
        ]);

        $cours = Cours::findOrFail($id);

        $cours->update([
            'nom' => $request->nom,
            'filiere_id' => $request->filiere_id,
            'semestre_id' => $request->semestre_id,
            'enseignant_id' => $request->enseignant_id,
            'nombre_heures' => $request->nombre_heures,
        ]);

        return redirect('/cours');
    }

    // delete
    public function delete($id)
    {
        Cours::findOrFail($id)->delete();

        return back();
    }
}