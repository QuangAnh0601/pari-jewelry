<?php

namespace App\Http\Requests;

use App\Rules\ProductReviewRule;
use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'rating' => 'required|numeric|min:1|max:5',
            'name' => 'required|string',
            'email' => 'required|email',
            'product_id' => ['required', new ProductReviewRule],
            'content' => 'nullable|string',
        ];
    }
}
