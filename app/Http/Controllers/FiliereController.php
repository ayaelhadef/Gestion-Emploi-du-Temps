<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;

class FiliereController extends Controller
{
    //  afficher toutes les filières
    public function index()
    {
        $filieres = Filiere::all();

        return view('filieres.index', compact('filieres'));
    }

    // enregistrer une filière
    public function store(Request $request)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        Filiere::create([
            'nom' => $request->nom
        ]);

        return redirect('/filieres');
    }

    public function update(Request $request, $id)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        $filiere = Filiere::findOrFail($id);

        $filiere->update([
            'nom' => $request->nom
        ]);

        return redirect('/filieres');
    }
}