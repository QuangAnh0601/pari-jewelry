<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BrandFilterRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $products = Product::where('visibility', "Display")->get();
        foreach ($value as $key => $item) {
            $compareValue = str_replace('-', ' ', $item);
            if(!in_array($compareValue, $products->pluck('brand')->toArray()))
            {
                $fail('The brand you are looking for is not in the system !');
            }
        }
    }
}
