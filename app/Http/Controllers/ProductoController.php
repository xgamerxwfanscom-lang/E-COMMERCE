<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['usuario', 'categorias'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $this->authorize('create', Producto::class);

        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $this->authorize('create', Producto::class);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'existencia' => $request->existencia,
            'usuario_id' => Auth::id(),
        ]);

        $producto->categorias()->attach($request->categorias);

        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
    {
        $this->authorize('update', $producto);

        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('update', $producto);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'existencia' => $request->existencia,
        ]);

        $producto->categorias()->sync($request->categorias);

        Log::channel('productos')->info('Producto editado', [
            'producto_id' => $producto->id,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $this->authorize('delete', $producto);

        Log::channel('productos')->info('Producto eliminado', [
            'producto_id' => $producto->id,
            'usuario_id' => Auth::id(),
        ]);

        $producto->delete();

        return redirect()->route('productos.index');
    }
}