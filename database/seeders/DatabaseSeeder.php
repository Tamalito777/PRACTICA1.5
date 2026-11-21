<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
                'rol' => 'administrador',
            ],
            [
                'name' => 'Estudiante 1',
                'email' => 'estudiante1@test.com',
                'password' => Hash::make('12345678'),
                'rol' => 'estudiante',
            ],
            [
                'name' => 'Estudiante 2',
                'email' => 'estudiante2@test.com',
                'password' => Hash::make('12345678'),
                'rol' => 'estudiante',
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::updateOrCreate(
                ['email' => $usuario['email']],
                $usuario
            );
        }

        $equipos = [
            [
                'codigo' => 'PC-01',
                'nombre' => 'Computadora 1',
                'especificaciones' => 'Intel i5, 16GB RAM, SSD 512GB',
                'estado' => 'disponible',
            ],
            [
                'codigo' => 'PC-02',
                'nombre' => 'Computadora 2',
                'especificaciones' => 'Intel i5, 16GB RAM, SSD 512GB',
                'estado' => 'disponible',
            ],
            [
                'codigo' => 'PC-03',
                'nombre' => 'Computadora 67',
                'especificaciones' => 'Ryzen 5, 16GB RAM, SSD 512GB',
                'estado' => 'disponible',
            ],
        ];

        foreach ($equipos as $equipo) {
            Equipo::updateOrCreate(
                ['codigo' => $equipo['codigo']],
                $equipo
            );
        }
    }
}