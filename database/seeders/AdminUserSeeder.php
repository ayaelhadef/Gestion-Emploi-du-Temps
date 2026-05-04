<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'prenom' => 'Admin',
            'nom' => 'System',
            'date_naissance' => '2004-09-03',
            'adresse' => 'Agadir',
            'email' => 'ENSIASD@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('2004-09-03')
        ]);
    }
}