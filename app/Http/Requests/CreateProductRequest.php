<?php

namespace App\Http\Requests;

use App\Rules\StockPackageRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
            'name' => ['required', Rule::unique('products')->ignore($this->id)],
            'cost' => 'required|numeric',
            'price' => 'required|numeric|gt:cost',
            'weight' => 'numeric|nullable',
            'status' => 'required',
            'visibility' => 'required',
            'images' => 'nullable',
            'images.*' => 'mimes:jpeg,png,jpg,gif',
            'stockPackage' => new StockPackageRule(),
        ];
    }
}
