<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReservacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "equipo_id" => "required|exists:equipos,id",
            "fecha_inicio" => "required|date",
            "fecha_fin" => "nullable|date|after:fecha_inicio",
        ];
    }

    public function messages(): array
    {
        return [
            "*.required" => "El valor es requerido",
            "equipo_id.exists" => "El equipo seleccionado no existe",
            "fecha_inicio.date" => "La fecha de inicio no es válida",
            "fecha_fin.date" => "La fecha de fin no es válida",
            "fecha_fin.after" => "La fecha de fin debe ser posterior a la fecha de inicio",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "mensaje" => "error de validaciones",
            "errores" => $validator->errors(),
        ]));
    }
}
