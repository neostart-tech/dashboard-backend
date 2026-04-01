<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lien;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Superadmin
        User::create([
            'nom' => 'Super',
            'prenom' => 'Admin',
            'email' => 'admin@neostart.com',
            'telephone' => null,
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        // Default Lien row
        Lien::create([
            'instagram' => null,
            'facebook' => null,
            'x' => null,
            'tiktok' => null,
        ]);

        // Default Contact row
        Contact::create([
            'telephone1' => null,
            'telephone2' => null,
            'email' => null,
            'adresse' => null,
        ]);
    }
}
