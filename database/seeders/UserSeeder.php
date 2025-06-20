<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        
        User::create([
            'name' => 'Admin',
            'lastName' => 'Principal',
            'email' => 'admin@example.com',
            'phoneNumber' => '1234567890',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Carlos',
            'lastName' => 'López',
            'email' => 'carlos.lopez@example.com',
            'phoneNumber' => '1111111111',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'María',
            'lastName' => 'Fernández',
            'email' => 'maria.fernandez@example.com',
            'phoneNumber' => '2222222222',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'José',
            'lastName' => 'Martínez',
            'email' => 'jose.martinez@example.com',
            'phoneNumber' => '3333333333',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Lucía',
            'lastName' => 'Gómez',
            'email' => 'lucia.gomez@example.com',
            'phoneNumber' => '4444444444',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Andrés',
            'lastName' => 'Ramírez',
            'email' => 'andres.ramirez@example.com',
            'phoneNumber' => '5555555555',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Elena',
            'lastName' => 'Ruiz',
            'email' => 'elena.ruiz@example.com',
            'phoneNumber' => '6666666666',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Pedro',
            'lastName' => 'Santos',
            'email' => 'pedro.santos@example.com',
            'phoneNumber' => '7777777777',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Ana',
            'lastName' => 'Méndez',
            'email' => 'ana.mendez@example.com',
            'phoneNumber' => '8888888888',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Javier',
            'lastName' => 'Vega',
            'email' => 'javier.vega@example.com',
            'phoneNumber' => '9999999999',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Sofía',
            'lastName' => 'Herrera',
            'email' => 'sofia.herrera@example.com',
            'phoneNumber' => '1010101010',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);

        User::create([
            'name' => 'Luis',
            'lastName' => 'Castro',
            'email' => 'luis.castro@example.com',
            'phoneNumber' => '1212121212',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
        ]);
    }
}
