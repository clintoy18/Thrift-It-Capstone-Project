<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'upcycler_id' => 'required|exists:users,id',
            'appdetails' => 'nullable|string|max:255',
            'apptype' => ['required', 'in:Resize,Customize,Patchwork,Fabric Dyeing'],
            'appstatus' => ['nullable', 'in:pending,approved,declined,completed'],
            'appdate' => 'required|date|after:now',
        ];
    }
}
