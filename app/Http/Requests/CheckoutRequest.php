<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:10|max:11',
            'shipping_address' => 'required',
            'country' => 'required',
            'postal_code' => 'required|numeric',
            'payment_id' => 'required',
            'ship_id' => 'required',
        ];
    }
}
