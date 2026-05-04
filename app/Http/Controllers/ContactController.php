<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // 📄 afficher form
    public function index()
    {
        return view('contact');
    }

    //  envoyer message
    public function store(Request $request)
    {
        //  VALIDATION AJOUTÉE
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Contact::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'sujet' => $request->sujet,
            'message' => $request->message
        ]);

        return back()->with('success', 'Message envoyé avec succès');
    }

    public function messages()
    {
        $messages = Contact::orderBy('created_at', 'desc')->get();

        return view('admin.contacts', compact('messages'));
    }
}