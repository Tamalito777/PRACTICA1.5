<?php

namespace App\Http\Repositories;

use App\Models\Equipo;
use App\Models\Reservacion;
use Illuminate\Support\Facades\DB;

class ReservacionRepository
{
    public function obtenerTodas()
    {
        return Reservacion::with(['usuario', 'equipo'])->get();
    }

    public function obtenerPorUsuario(int $userId)
    {
        return Reservacion::with(['usuario', 'equipo'])
            ->where("user_id", "=", $userId)
            ->get();
    }

    public function buscarPorId(int $id)
    {
        return Reservacion::with(['usuario', 'equipo'])
            ->where("id", "=", $id)
            ->first();
    }

    public function crearReservacion(int $userId, array $datos)
    {
        return DB::transaction(function () use ($userId, $datos) {
            $equipo = Equipo::where("id", "=", $datos['equipo_id'])
                ->lockForUpdate()
                ->first();

            if (!$equipo) {
                return [
                    "ok" => false,
                    "mensaje" => "El equipo no existe"
                ];
            }

            if ($equipo->estado !== 'disponible') {
                return [
                    "ok" => false,
                    "mensaje" => "El equipo ya no está disponible para reservar"
                ];
            }

            $reservacion = Reservacion::create([
                "user_id" => $userId,
                "equipo_id" => $equipo->id,
                "fecha_inicio" => $datos['fecha_inicio'],
                "fecha_fin" => $datos['fecha_fin'] ?? null,
                "estado" => "activa",
            ]);

            $equipo->estado = 'reservado';
            $equipo->save();

            return [
                "ok" => true,
                "mensaje" => "Reservación realizada con éxito",
                "reservacion" => $reservacion
            ];
        });
    }

    public function cancelarReservacion(int $reservacionId, int $userId, string $rol)
    {
        return DB::transaction(function () use ($reservacionId, $userId, $rol) {
            $reservacion = Reservacion::where("id", "=", $reservacionId)->first();

            if (!$reservacion) {
                return [
                    "ok" => false,
                    "mensaje" => "Reservación no encontrada"
                ];
            }

            if ($rol !== 'administrador' && $reservacion->user_id !== $userId) {
                return [
                    "ok" => false,
                    "mensaje" => "No tienes permiso para cancelar esta reservación"
                ];
            }

            if ($reservacion->estado !== 'activa') {
                return [
                    "ok" => false,
                    "mensaje" => "La reservación ya no está activa"
                ];
            }

            $reservacion->estado = 'cancelada';
            $reservacion->save();

            $equipo = Equipo::where("id", "=", $reservacion->equipo_id)
                ->lockForUpdate()
                ->first();

            if ($equipo && $equipo->estado === 'reservado') {
                $equipo->estado = 'disponible';
                $equipo->save();
            }

            return [
                "ok" => true,
                "mensaje" => "Reservación cancelada"
            ];
        });
    }
}