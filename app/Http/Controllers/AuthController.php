<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AuthRepository;
use App\Http\Requests\AuthLoginRequest;
use Exception;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $AuthRepository)
    {
        $this->authRepository = $AuthRepository;
    }

    public function login(AuthLoginRequest $AuthRequest)
    {
        try {
            $resultado = $this->authRepository->Login($AuthRequest->validated());

            if (!$resultado["ok"]) {
                return redirect("/login")->with([
                    "mensaje" => $resultado["mensaje"]
                ]);
            }

            return redirect("/home")->with([
                "mensaje" => $resultado["mensaje"]
            ]);
        } catch (Exception $e) {
            return redirect("/login")->with([
                "mensaje" => $e->getMessage()
            ]);
        }
    }

    public function cerrarSesion()
    {
        try {
            $this->authRepository->cerrarSesion();
            return redirect("/login")->with([
                "mensaje" => "Sesion cerrada correctamente"
            ]);
        } catch (Exception $e) {
            return redirect("/home")->with([
                "mensaje" => "Error"
            ]);
        }
    }
}