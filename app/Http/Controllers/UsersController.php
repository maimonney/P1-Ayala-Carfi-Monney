<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string|in:admin,user',
        ], 
        [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, intente nuevamente.',
        ]);

        Users::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function show(Users $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit($userId)
{
    $user = Users::with('reservas')->find($userId);

    if (!$user) {
        return redirect()->route('admin.users.index')->with('error', 'Usuario no encontrado.');
    }

    return view('admin.users.edit', compact('user'));
}


    public function update(Request $request, $userId)
    {
        $user = Users::findOrFail($userId);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => 'nullable|confirmed|min:6',
            'role' => 'required|in:user,admin',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }
    
        if ($request->has('reservas')) {
            foreach ($request->reservas as $reservaId => $status) {
                // Asegurarse de que el estado sea válido
                if (!in_array($status, ['pendiente', 'completada'])) {
                    return redirect()->route('admin.users.index')->with('error', 'Estado de reserva inválido.');
                }
        
                // Encuentra la reserva y actualiza el estado
                $reserva = Reserva::find($reservaId);
                if ($reserva) {
                    $reserva->status = $status;  
                    $reserva->save();
                }
            }
        }
        
    
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }
    
    

    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
