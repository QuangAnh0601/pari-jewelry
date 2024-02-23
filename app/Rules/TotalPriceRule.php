<?php

namespace App\Rules;

use App\Models\OrderDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class TotalPriceRule implements ValidationRule, DataAwareRule
{
    protected $data = [];
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderDetail = OrderDetail::find($this->data['orderDetailId']);
        $unitPrice = $orderDetail->product->price;
        $price = $this->data['quantity'] * $unitPrice;
        if($value != $price)
        {
            $fail('the total amount must be equal to the unit price times the quantity of products !');
        }
    }
}
