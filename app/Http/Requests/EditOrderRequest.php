<?php

namespace App\Http\Requests;

use App\Rules\CouponOrderRule;
use App\Rules\ProductOrderRule;
use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
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
            'customer_id' => 'required',
            'product' => ['required', new ProductOrderRule],
            'payment_id' => 'required',
            'ship_id' => 'required',
            'payment_id' => 'required',
            'shipping_address' => 'required',
            'total_price' => 'required|numeric',
            'coupon_code' => ['required', 'uuid', new CouponOrderRule],
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:10|max:11',
            'country' => 'required',
            'postal_code' => 'required|numeric',
        ];
    }
}
