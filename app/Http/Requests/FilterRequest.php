<?php

namespace App\Http\Requests;

use App\Rules\BrandFilterRule;
use App\Rules\CategoryFilterRule;
use App\Rules\MaterialFilterRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'sort_by' => 'nullable|in:latest,popularity,rating',
            'category_filter' => ['nullable', new CategoryFilterRule],
            'material_filter' => ['nullable', new MaterialFilterRule],
            'price_filter' => 'nullable|numeric|min:0|max:1000000000',
            'brand_filter' => ['nullable', new BrandFilterRule],
        ];
    }
}
