<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow only authenticated users with admin role
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string',
            'profile' => 'mimes:jpeg,jpg,png|max:5000', // 5MB max size
            'company_id' => 'required|exists:companies,id',
        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email format is invalid.',
            'email.unique' => 'This email is already taken.',
            'profile.required' => 'The profile image is required.',
            'profile.mimes' => 'The profile must be a file of type: jpeg, jpg, png.',
            'profile.max' => 'The profile must not exceed 5MB.',
            'company_id.exists' => 'The selected company does not exist.',
        ];
    }
}


