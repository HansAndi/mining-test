<?php

namespace App\Http\Requests;

use App\Enums\Approval;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreReservationRequest extends FormRequest
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'location_id' => 'required|exists:locations,id',
            'driver_id' => 'required|exists:users,id',
            'user_id' => 'required|exists:users,id',
            // 'admin_id' => 'required|exists:users,id',
            'leader_id' => 'required|exists:users,id',
            // 'status_id' => 'required|exists:reservation_statuses,id',
            'admin_approved' => ['required', new Enum(Approval::class)],
            // 'leader_approved' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
