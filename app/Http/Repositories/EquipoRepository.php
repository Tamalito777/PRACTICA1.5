<?php

namespace App\Http\Repositories;

use App\Models\Equipo;

class EquipoRepository
{
    public function obtenerTodos()
    {
        return Equipo::all();
    }

    public function obtenerDisponibles()
    {
        return Equipo::where("estado", "=", "disponible")->get();
    }

    public function buscarPorId(int $id)
    {
        return Equipo::where("id", "=", $id)->first();
    }

    public function crear(array $datos)
    {
        return Equipo::create($datos);
    }

    public function actualizar(int $id, array $datos)
    {
        $equipo = Equipo::where("id", "=", $id)->first();
        if (!$equipo) {
            return null;
        }
        $equipo->update($datos);
        $equipo->save();
        return $equipo;
    }

    public function eliminar(int $id)
    {
        $equipo = Equipo::where("id", "=", $id)->first();
        if (!$equipo) {
            return false;
        }
        $equipo->delete();
        return true;
    }
}