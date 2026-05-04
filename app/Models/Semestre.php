<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}