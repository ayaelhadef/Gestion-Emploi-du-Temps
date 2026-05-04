<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    // afficher salles
    public function index()
    {
        $salles = Salle::all();

        return view('salles.index', compact('salles'));
    }

    // ajouter salle
    public function store(Request $request)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|numeric|min:1'
        ]);

        Salle::create([
            'nom' => $request->nom,
            'capacite' => $request->capacite
        ]);

        return redirect('/salles');
    }

    // modifier salle
    public function update(Request $request, $id)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|numeric|min:1'
        ]);

        $salle = Salle::findOrFail($id);

        $salle->update([
            'nom' => $request->nom,
            'capacite' => $request->capacite
        ]);

        return redirect('/salles');
    }

    //  supprimer
    public function delete($id)
    {
        Salle::findOrFail($id)->delete();

        return back();
    }
}