<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ajusta si usas otro namespace
use Illuminate\Support\Facades\Hash;
use Filament\Models\Contracts\FilamentUser;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminCoreSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'is_admin' => true, // si tienes este campo para distinguir admins
                'status' => 1,      // o cualquier otro campo relevante
            ]
        );
    }
}
