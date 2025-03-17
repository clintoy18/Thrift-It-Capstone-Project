<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',

        ];
    }

    //ERROR MESSAGE
    public function messages()
    {
        return [
            'content.required' => 'The comment field cannot be empty.',
            'content.string' => 'The comment must be a valid text.',
            'content.max' => 'The comment cannot exceed 500 characters.',
        ];
    }
}
