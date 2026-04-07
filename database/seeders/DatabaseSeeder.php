<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Luis',
            'apellidos' => 'Perez',
            'correo' => 'luis@tuxtla.tecnm.mx',
            'clave' => Hash::make('123'),
            'rol' => 'administrador',
        ]);

        Usuario::create([
            'nombre' => 'Maria',
            'apellidos' => 'Lopez',
            'correo' => 'maria@tuxtla.tecnm.mx',
            'clave' => Hash::make('123'),
            'rol' => 'cliente',
        ]);

        Usuario::create([
            'nombre' => 'Mario',
            'apellidos' => 'Sanchez',
            'correo' => 'msanchez@tuxtla.tecnm.mx',
            'clave' => Hash::make('123'),
            'rol' => 'gerente',
        ]);

        Usuario::factory()->count(2)->create();

        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}