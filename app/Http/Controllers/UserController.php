<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Filiere;
use App\Models\Semestre;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // afficher tous les utilisateurs
    public function etudiants()
    {
        $users = User::where('role', 'etudiant')
            ->with(['filiere', 'semestre'])
            ->get();

        $filieres = Filiere::all();
        $semestres = Semestre::all();

        return view('users.etudiants', compact(
            'users',
            'filieres',
            'semestres'
        ));
    }

    public function storeEtudiant(Request $request)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'numero_etudiant' => 'required|unique:users,numero_etudiant',
            'filiere_id' => 'required',
            'semestre_id' => 'required',
        ]);

        User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'email' => $request->email,

            'password' => Hash::make($request->date_naissance),

            'role' => 'etudiant',

            'numero_etudiant' => $request->numero_etudiant,

            'filiere_id' => $request->filiere_id,
            'semestre_id' => $request->semestre_id,
        ]);

        return redirect('/etudiants');
    }

    // supprimer utilisateur
    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return back();
    }

    // ✏️ modifier étudiant
    public function updateEtudiant(Request $request, $id)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email',
            'numero_etudiant' => 'required',
            'filiere_id' => 'required',
            'semestre_id' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'numero_etudiant' => $request->numero_etudiant,
            'filiere_id' => $request->filiere_id,
            'semestre_id' => $request->semestre_id,
        ]);

        return redirect('/etudiants');
    }

    // ✏️ modifier enseignant
    public function updateEnseignant(Request $request, $id)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'email' => $request->email,
        ]);

        return redirect('/enseignants');
    }

    public function enseignants()
    {
        $users = User::where('role', 'enseignant')->get();

        return view('users.enseignants', compact('users'));
    }

    public function storeEnseignant(Request $request)
    {
        // VALIDATION AJOUTÉE
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'email' => $request->email,

            'password' => Hash::make($request->date_naissance),

            'role' => 'enseignant',
        ]);

        return redirect('/enseignants');
    }
}