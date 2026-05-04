<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
    'prenom',
    'nom',
    'date_naissance',
    'adresse',
    'email',
    'password', // c'est OBLIGATOIRE d'ajouter le password 
    'role',
    'numero_etudiant',
    'filiere_id',
    'semestre_id',
];
    

    
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }


    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }


    public function coursEnseignes()
    {
        return $this->hasMany(Cours::class, 'enseignant_id');
    }
}