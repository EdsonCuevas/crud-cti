<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class VolunteersController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $volunteers = User::where('role_id', '3')->with('programs:name')->get();
        $roles = Role::all();

        return Inertia::render('Users/Volunteers', [
            'voluntarios' => $volunteers,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'password' => 'required|min:8',
            'phone' => ['required', 'digits_between:1,15'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 60 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 60 caracteres.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.digits_between' => 'El número de teléfono debe tener entre 1 y 15 dígitos.',
        ]);

        $volunteer = new User($request->except('password'));
        $volunteer->role_id = '3';
        $volunteer->password = Hash::make($request->password);
        $volunteer->save();
        return redirect('volunteers');
    }

    public function update(Request $request, User $volunteer)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => ['required', 'digits_between:1,15'],
            'role_id' => 'required',
            'password' => 'nullable|min:8',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 60 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 60 caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.digits_between' => 'El número de teléfono debe tener entre 1 y 15 dígitos.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Solo encripta la contraseña si fue proporcionada
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $volunteer->update($request->all());
        return redirect('volunteers');
    }

    public function destroy(User $volunteer)
    {
        $volunteer->delete();
        return redirect('volunteers');
    }
}
