<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCustomerProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'email'=> ['required', Rule::unique('customers', 'email')->ignore($this->id), 'email'],
            'age' => 'required|numeric|integer|between:18, 60',
            'phone_number' => 'required|regex:/^0[0-9]{9}$/',
        ];
    }
}
