<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;

class ActivoController extends Controller
{
    public function index()
    {
        $activos = Activo::all();
        return view('activos.index', compact('activos'));
    }

    public function create()
    {
        return view('activos.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'initial_amount' => 'required|numeric|min:0',
        ]);

        $ultimoCodigo = Activo::latest('id')->value('code');

        if (!$ultimoCodigo) {
            $codigo = 'CM001';
        } else {

            $numeroCodigo = intval(substr($ultimoCodigo, 2));

            $nuevoNumeroCodigo = $numeroCodigo + 1;
            $nuevoNumeroCodigoFormateado = str_pad($nuevoNumeroCodigo, 3, '0', STR_PAD_LEFT);
            $codigo = 'CM' . $nuevoNumeroCodigoFormateado;
        }

        Activo::create([
            'name' => $request->name,
            'code' => $codigo,
            'description' => $request->description,
            'initial_amount' => $request->initial_amount,
        ]);

        return redirect()->route('activos.index')->with('success', 'Activo creado exitosamente.');
    }


    public function edit(Activo $activo)
    {
        return view('activos.edit', compact('activo'));
    }

    public function update(Request $request, Activo $activo)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Actualizar activo
        $activo->update($request->all());

        return redirect()->route('activos.index')->with('success', 'Activo actualizado exitosamente.');
    }

    public function destroy(Activo $activo)
    {
        // Eliminar activo
        $activo->delete();
        return redirect()->route('activos.index')->with('success', 'Activo eliminado exitosamente.');
    }
}
