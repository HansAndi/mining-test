<?php

namespace App\Http\Requests;

use App\Enums\Approval;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
        if ($this->reservation->status_id != 2) {
            return [
                'vehicle_id' => 'nullable|exists:vehicles,id',
                'location_id' => 'nullable|exists:locations,id',
                'driver_id' => 'nullable|exists:users,id',
                'user_id' => 'nullable|exists:users,id',
                'leader_id' => 'nullable|exists:users,id',
                'admin_approved' => ['nullable', new Enum(Approval::class)],
                'leader_approved' => $this->user()->role_id == 'leader' ? ['nullable', new Enum(Approval::class)] : 'nullable',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'is_returned' => 'nullable|boolean',
                'fuel_usage' => 'nullable|numeric',
            ];
        }

        return [
            // 'vehicle_id' => 'nullable|exists:vehicles,id',
            'location_id' => 'nullable|exists:locations,id',
            'driver_id' => 'nullable|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'leader_id' => 'nullable|exists:users,id',
            'admin_approved' => ['nullable', new Enum(Approval::class)],
            'leader_approved' => $this->user()->role_id == 'leader' ? ['nullable', new Enum(Approval::class)] : 'nullable',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_returned' => 'nullable|boolean',
            'fuel_usage' => 'nullable|numeric',
        ];
    }
}
