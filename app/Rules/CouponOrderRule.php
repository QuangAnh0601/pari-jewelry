<?php

namespace App\Rules;

use App\Models\Coupon;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CouponOrderRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $coupon = Coupon::where([
            ['code','like', $value],
            ['out_of_date', '>=', Carbon::now()]
        ])->first();
        if(!isset($coupon))
        {
            $fail('the coupon has expired');
        }
    }
}
