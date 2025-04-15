<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'approval_status' => 'in:approved,pending,rejected',
            'size' => 'required|in:S,M,L,XL,XXL,3XL,4XL,5XL',
            'image' => 'nullable|image|max:2048',
            'qty' => 'integer',
            'listingtype' => 'required|in:for sale,for donation',
            'status' => 'required|in:available,sold',
        ];
    }
}
