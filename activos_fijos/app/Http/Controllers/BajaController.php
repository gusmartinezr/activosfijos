<?php


namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Baja;
use Illuminate\Http\Request;

class BajaController extends Controller
{
    public function index()
    {
        $bajas = Baja::all();
        return view('bajas.index', compact('bajas'));
    }

    public function create()
    {
        return view('bajas.create');
    }

    public function store(Request $request)
    {
        // Validar otros campos
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'reason' => 'required',
            'date' => 'required|date',
            'activo_id' => 'required|exists:activos,id',
        ]);

        // Obtener el activo
        $activo = Activo::findOrFail($request->activo_id);

        // Validar si la cantidad a dar de baja supera el stock actual
        if ($request->quantity > $activo->stockActual()) {
            // Si la cantidad supera el stock, redirigir de vuelta con un mensaje de error
            return redirect()->route('activos.index')->with('error', 'La cantidad a dar de baja supera el stock actual del activo.');
        }

        // Crear la baja si pasa todas las validaciones
        Baja::create($request->all());

        return redirect()->route('activos.index')->with('success', 'Baja registrada exitosamente.');
    }
}
