<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCouponRequest extends FormRequest
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
            'name' => ['required', Rule::unique('coupons', 'name')->ignore($this->id), 'max:50'],
            'code' => ['uuid', Rule::unique('coupons', 'code')->ignore($this->id), 'max:50'],
            'type' => 'required',
            'quantity' => 'required|numeric',
            'out_of_date' => ['required', 'date', 'after:today'],
            'discount_percent' => 'required|numeric|between:5,100',
            'status' => 'required',
        ];
    }
}
