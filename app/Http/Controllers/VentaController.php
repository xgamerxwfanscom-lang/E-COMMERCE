<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        $ventas = Venta::with(['producto', 'cliente', 'vendedor'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        $productos = Producto::all();
        $clientes = Usuario::where('rol', 'cliente')->get();

        return view('ventas.create', compact('productos', 'clientes'));
    }

    public function store(StoreVentaRequest $request)
    {
        if (!in_array(auth()->user()->rol, ['administrador', 'gerente'])) {
            abort(403, 'Acceso denegado');
        }

        $venta = Venta::create([
            'producto_id' => $request->producto_id,
            'cliente_id' => $request->cliente_id,
            'vendedor_id' => Auth::id(),
            'fecha' => now()->toDateString(),
            'total' => $request->total,
        ]);

        Log::channel('ventas')->info('Venta creada', [
            'venta_id' => $venta->id,
            'cliente_id' => $venta->cliente_id,
            'vendedor_id' => $venta->vendedor_id,
        ]);

        return redirect()->route('ventas.index');
    }
}