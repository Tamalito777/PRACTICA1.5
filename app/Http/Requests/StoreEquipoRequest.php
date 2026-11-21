<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEquipoRequest extends FormRequest
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
        $equipoId = $this->route('id') ?? $this->route('equipo');

        return [
            "codigo" => "required|string|max:50|unique:equipos,codigo," . $equipoId,
            "nombre" => "required|string|max:100",
            "especificaciones" => "nullable|string|max:255",
            "estado" => "required|in:disponible,reservado,mantenimiento",
        ];
    }

    public function messages(): array
    {
        return [
            "*.required" => "El valor es requerido",
            "*.string" => "El valor debe ser texto",
            "*.max" => "El valor excede la longitud permitida",
            "codigo.unique" => "El código del equipo ya está registrado",
            "estado.in" => "El estado del equipo no es válido",
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
