<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'salle_id',
        'jour',
        'heure_debut',
        'heure_fin'
    ];

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}