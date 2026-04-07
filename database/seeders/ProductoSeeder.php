<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $vendedor = Usuario::where('rol', 'gerente')->first();

        if (!$vendedor) {
            return;
        }

        $producto1 = Producto::create([
            'nombre' => 'Laptop HP',
            'descripcion' => 'Laptop para trabajo de oficina',
            'precio' => 14500,
            'existencia' => 6,
            'usuario_id' => $vendedor->id,
        ]);

        $producto2 = Producto::create([
            'nombre' => 'Mouse inalámbrico',
            'descripcion' => 'Mouse ergonómico para computadora',
            'precio' => 350,
            'existencia' => 20,
            'usuario_id' => $vendedor->id,
        ]);

        $categoria1 = Categoria::where('nombre', 'Computadoras')->first();
        $categoria2 = Categoria::where('nombre', 'Oficina')->first();

        if ($categoria1) {
            $producto1->categorias()->attach($categoria1->id);
            $producto2->categorias()->attach($categoria1->id);
        }

        if ($categoria2) {
            $producto2->categorias()->attach($categoria2->id);
        }
    }
}