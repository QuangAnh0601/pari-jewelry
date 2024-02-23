<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaterialFilterRule implements ValidationRule
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
            if(!in_array($compareValue, $products->pluck('material')->toArray()))
            {
                $fail('The material you are looking for is not in the system !');
            }
        }
    }
}
