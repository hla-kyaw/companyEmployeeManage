<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $this->employee->id,
            'phone' => 'nullable|string',
            'profile' => 'mimes:jpeg,jpg,png|max:5000',
            'company_id' => 'required|exists:companies,id',
        ];
    }
}

