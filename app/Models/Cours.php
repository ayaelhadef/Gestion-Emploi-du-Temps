<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'filiere_id',
        'semestre_id',
        'enseignant_id',
        'nombre_heures',
    ];


    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    //enseignant (user avec role enseignant)
    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }
    public function emplois()
{
    return $this->hasMany(Emploi::class);
}
}