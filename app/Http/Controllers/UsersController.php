<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('admin.users.index', compact('users'));
    }

    public function perfil()
{
    $user = auth()->user();

    return view('perfil.user', compact('user'));
}

public function editPerfil(Users $user)
{
    return view('perfil.editar', compact('user'));
}
public function updatePerfil(Request $request, Users $user)
{
    // Validación de los datos recibidos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|confirmed|min:6',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no puede tener más de 255 caracteres.',
    
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Por favor, ingrese un correo electrónico válido.',
        'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
        'email.unique' => 'El correo electrónico ya está registrado.',
    
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    
        'avatar.image' => 'El archivo debe ser una imagen.',
        'avatar.mimes' => 'La imagen debe tener uno de los siguientes formatos: jpeg, png, jpg, gif.',
        'avatar.max' => 'La imagen no puede superar los 2MB.',
    ]);    

    if ($request->hasFile('avatar')) {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $rutaAvatar = $request->file('avatar')->store('img/avatars', 'public');
    } else {
        $rutaAvatar = $user->avatar;
    }

    // Actualizamos los demás campos
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'avatar' => $rutaAvatar, 
    ]);

    if ($request->filled('password')) {
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    }

    return redirect()->route('perfil.user')->with('success', 'Perfil actualizado correctamente.');

}



    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request){

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|string|in:admin,user',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $rutaAvatar = null;
    if ($request->hasFile('avatar')) {
        $rutaAvatar = $request->file('avatar')->store('img/avatars', 'public');
    }

    Users::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'avatar' => $rutaAvatar,  
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Lógica para manejar el avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $rutaAvatar = $request->file('avatar')->store('img/avatars', 'public');
        } else {
            $rutaAvatar = $user->avatar;
        }
    
        // Actualizar datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $rutaAvatar,
        ]);
    
        // Si se proporciona una nueva contraseña, se actualiza
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }
    
        // Actualizar el status de las reservas
        if ($request->has('reservas')) {
            foreach ($request->reservas as $reservaId => $estado) {
                $user->reservas()->where('id', $reservaId)->update([
                    'status' => $estado,
                ]);
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
