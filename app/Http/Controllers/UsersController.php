<?php

namespace App\Http\Controllers;

use App\Models\Users;
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
            'role' => 'required|string',
        ]);

        Users::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function show(Users $user) 
    {
        return view('admin.users.show', compact('user')); 
    }

    public function edit(Users $user)
    {
        return view('admin.users.edit', compact('user')); 
    }

    public function update(Request $request, Users $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
