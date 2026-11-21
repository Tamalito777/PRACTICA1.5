<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthRepository
{
    public function Login(array $credenciales)
    {
        $user = User::where("email", "=", $credenciales['email'])->first();
        if (!$user) {
            return [
                "ok" => false,
                "mensaje" => "Usuario no encontrado"
            ];
        }

        if (Auth::attempt($credenciales)) {
            request()->session()->regenerate();
            return [
                "ok" => true,
                "mensaje" => "Usuario logeado",
                "usuario" => Auth::user()
            ];
        }

        return [
            "ok" => false,
            "mensaje" => "Credenciales incorrectas"
        ];
    }

    public function RegistrarUsuario(array $usuario)
    {
        $nuevoUsuario = User::create([
            "name" => $usuario['nombre'],
            "email" => $usuario['correo'],
            "password" => Hash::make($usuario['contraseña']),
            "rol" => $usuario['rol'] ?? 'estudiante',
        ]);

        return [
            "mensaje" => "usuario registrado",
            "usuario" => $nuevoUsuario
        ];
    }

    public function cerrarSesion()
    {
        Session::flush();
        Session::invalidate();
        Session::regenerateToken();
        Auth::logout();
    }
}