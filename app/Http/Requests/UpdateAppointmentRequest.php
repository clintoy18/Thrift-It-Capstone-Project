<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'upcycler_id' => 'required|exists:users,id', // Ensure the upcycler exists
            'appdetails' => 'nullable|string|max:255',
            'apptype' => 'required|string|max:20',
            'appstatus' => 'nullable|string|max:20', // Optional status update
            'appdate' => 'required|date|after:now',
        ];
    }
}
