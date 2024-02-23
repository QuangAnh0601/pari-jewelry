<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryFilterRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $compareValue = str_replace('-', ' ', $value);
        $category = Category::Where('visibility', 'Display')->get();
        if(!in_array($compareValue, $category->pluck('name')->toArray()))
        {
            $fail('The category you are looking for is not in the system !');
        }
    }
}
