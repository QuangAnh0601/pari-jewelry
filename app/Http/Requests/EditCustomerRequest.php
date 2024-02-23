<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditCustomerRequest extends FormRequest
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
            'name' => ['required', Rule::unique('customers', 'name')->ignore($this->id), 'max:50'],
            'age' => 'required|numeric|min:18|max:100',
            'phone_number' => 'required|regex:/^0[0-9]{9}$/',
            'email' => ['required', 'email', Rule::unique('customers', 'email')->ignore($this->id)],
            'address' => 'required|max:80',
            'ward' => 'required|max:80',
            'district' => 'required|max:80',
            'city' => 'required|max:80',
            'full_name' => 'required|max:50',
        ];
    }
}
