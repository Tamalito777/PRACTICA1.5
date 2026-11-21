<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EquipoRepository;
use App\Http\Requests\StoreEquipoRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    protected $equipoRepository;

    public function __construct(EquipoRepository $EquipoRepository)
    {
        $this->equipoRepository = $EquipoRepository;
    }

    public function GetEquipos()
{
    $usuario = Auth::user();

    if ($usuario->rol === 'administrador') {
        $equipos = $this->equipoRepository->obtenerTodos();
    } else {
        $equipos = $this->equipoRepository->obtenerDisponibles();
    }

    return view('Home', compact('equipos', 'usuario'));
}

public function CreateEquipo(StoreEquipoRequest $request)
{
    try {
        $this->equipoRepository->crear($request->validated());
        return redirect('/home')->with(['mensaje' => 'Equipo registrado']);
    } catch (Exception $e) {
        return redirect('/home')->with(['mensaje' => $e->getMessage()]);
    }
}

public function UpdateEquipo(int $id, StoreEquipoRequest $request)
{
    try {
        $actualizado = $this->equipoRepository->actualizar($id, $request->validated());
        if (!$actualizado) {
            return redirect('/home')->with(['mensaje' => 'Equipo no encontrado']);
        }
        return redirect('/home')->with(['mensaje' => 'Equipo actualizado']);
    } catch (Exception $e) {
        return redirect('/home')->with(['mensaje' => $e->getMessage()]);
    }
}

public function DeleteEquipo(int $id)
{
    try {
        $eliminado = $this->equipoRepository->eliminar($id);
        if (!$eliminado) {
            return redirect('/home')->with(['mensaje' => 'Equipo no encontrado']);
        }
        return redirect('/home')->with(['mensaje' => 'Equipo eliminado']);
    } catch (Exception $e) {
        return redirect('/home')->with(['mensaje' => $e->getMessage()]);
    }
}
}