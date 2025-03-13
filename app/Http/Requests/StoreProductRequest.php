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

        'name' =>['required','string','max:50'],
        'description' =>['required','string','max:255'],
        'price'=>['required'],
        'image' =>['required','string','max:50'],
        'qty' =>['required'],
        'listingtype' => ['required', 'in:for sale,for donation'],
        'status' => ['required', 'in:available,sold']
        ];
    }
}
