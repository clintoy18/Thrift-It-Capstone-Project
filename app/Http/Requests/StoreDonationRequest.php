<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreDonationRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id', 
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'approval_status' => 'in:approved,pending,rejected',
            'size' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'in:available,sold',
        ];
    }
}
