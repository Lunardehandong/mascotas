<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'fecha_de_nacimiento' => ['required', 'date'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Validación para la nueva contraseña
        ]);

        // Actualizar los campos principales del usuario
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->fecha_de_nacimiento = $request->fecha_de_nacimiento;

        // Actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('home')->with('success', 'User updated successfully.');
    }
}
