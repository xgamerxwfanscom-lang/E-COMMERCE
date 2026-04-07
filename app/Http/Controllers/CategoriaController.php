<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        $categorias = Categoria::with('productos')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        return view('categorias.create');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('categorias.index');
    }
}