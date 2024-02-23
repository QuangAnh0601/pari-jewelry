<?php

namespace App\Rules;

use App\Models\Product;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductOrderRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $productPakage) {
            $productInfo = json_decode($productPakage);
            $product = Product::find($productInfo->product_id);
            $checkPivotQuantity = $product->stocks()->wherePivot('quantity','>=', $productInfo->quantity)->first();
            $checkPivotExpired = $product->stocks()->wherePivot('out_of_date','>=', Carbon::now())->first();
            if($productInfo->quantity == 0)
            {
                $fail('quantity must be greater than 0 !');
            }
            if(!isset($checkPivotQuantity))
            {
                $fail("The number of $product->name in stock is not enough !");
            }
            if(!isset($checkPivotExpired))
            {
                $fail("$product->name has expired !");
            }
        }
    }
}
