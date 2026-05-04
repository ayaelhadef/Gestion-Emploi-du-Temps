<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //  VALIDATION 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email ou mot de passe incorrect');
        }

        Auth::login($user);

        if ($user->role == 'admin') {
            return redirect('/admin');
        }

        if ($user->role == 'etudiant') {
            return redirect('/etudiant/dashboard');
        }

        if ($user->role == 'enseignant') {
            return redirect('/enseignant/dashboard');
        }

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}