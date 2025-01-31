<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePelatihanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'required|string',
            'name' => 'required|string',
            'client_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'training_type' => 'required',
            'description' => 'required|string',
            'status' => 'required',
            'tanggal_jam' => 'required',
        ];
    }
}
