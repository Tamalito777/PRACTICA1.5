<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with([
                'mensaje' => 'Debes iniciar sesión'
            ]);
        }

        $usuario = Auth::user();

        if (!in_array($usuario->rol, $roles, true)) {
            return redirect('/home')->with([
                'mensaje' => 'No tienes permisos para realizar esta acción'
            ]);
        }

        return $next($request);
    }
}
