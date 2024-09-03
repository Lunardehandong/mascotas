<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        // Obtén las mascotas que pertenecen al usuario autenticado
        $mascotas = Mascota::where('user_id', auth()->id())->get();
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        return view('mascotas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:10',
            'tipo' => 'required|in:perro,gato',
        ]);

        // Crea una nueva mascota asociada al usuario autenticado
        Mascota::create([
            'user_id' => auth()->id(),
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('mascota.index')->with('success', 'Mascota creada correctamente.');
    }

    public function edit(Mascota $mascota)
    {
        // Verifica que la mascota pertenezca al usuario autenticado
        if ($mascota->user_id !== auth()->id()) {
            return redirect()->route('mascota.index')->with('error', 'No tienes permiso para editar esta mascota.');
        }

        return view('mascotas.edit', compact('mascota'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        // Verifica que la mascota pertenezca al usuario autenticado
        if ($mascota->user_id !== auth()->id()) {
            return redirect()->route('mascota.index')->with('error', 'No tienes permiso para actualizar esta mascota.');
        }

        $request->validate([
            'nombre' => 'required|string|max:10',
            'tipo' => 'required|in:perro,gato',
        ]);

        // Actualiza la información de la mascota
        $mascota->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('mascota.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy(Mascota $mascota)
    {
        // Verifica que la mascota pertenezca al usuario autenticado
        if ($mascota->user_id !== auth()->id()) {
            return redirect()->route('mascota.index')->with('error', 'No tienes permiso para eliminar esta mascota.');
        }

        // Elimina la mascota
        $mascota->delete();

        return redirect()->route('mascota.index')->with('success', 'Mascota eliminada correctamente.');
    }
}


