<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:Person,Cargo'],
            'ownership' => ['required', 'string', 'in:Company,Rental'],
            'status_id' => ['required', 'integer', 'exists:vehicle_statuses,id'],
            // 'last_used_at' => ['nullable', 'date'],
        ];
    }
}
