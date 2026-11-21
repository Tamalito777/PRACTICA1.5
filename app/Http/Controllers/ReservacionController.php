<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReservacionRepository;
use App\Http\Requests\StoreReservacionRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    protected $reservacionRepository;

    public function __construct(ReservacionRepository $ReservacionRepository)
    {
        $this->reservacionRepository = $ReservacionRepository;
    }

    public function GetReservaciones()
    {
        $usuario = Auth::user();

        if ($usuario->rol === 'administrador') {
            $reservaciones = $this->reservacionRepository->obtenerTodas();
        } else {
            $reservaciones = $this->reservacionRepository->obtenerPorUsuario($usuario->id);
        }

        return view('reservaciones', compact('reservaciones', 'usuario'));
    }

    public function CreateReservacion(StoreReservacionRequest $request)
    {
        try {
            $usuario = Auth::user();
            $resultado = $this->reservacionRepository->crearReservacion($usuario->id, $request->validated());

            return redirect('/reservaciones')->with([
                'mensaje' => $resultado['mensaje']
            ]);
        } catch (Exception $e) {
            return redirect('/equipos')->with([
                'mensaje' => $e->getMessage()
            ]);
        }
    }

    public function CancelarReservacion(int $id)
    {
        try {
            $usuario = Auth::user();
            $resultado = $this->reservacionRepository->cancelarReservacion($id, $usuario->id, $usuario->rol);

            return redirect('/reservaciones')->with([
                'mensaje' => $resultado['mensaje']
            ]);
        } catch (Exception $e) {
            return redirect('/reservaciones')->with([
                'mensaje' => $e->getMessage()
            ]);
        }
    }
}