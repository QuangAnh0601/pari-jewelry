<?php

namespace App\Rules;

use App\Models\Stock;
use Carbon\Carbon;
use Closure;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class StockPackageRule implements ValidationRule, DataAwareRule
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
        $arr = json_decode($value);

        if($value === null)
        {
            $fail('You must enter all the fields');
        }
        else
        {
            foreach ($arr as $item) {
                if(empty($item->quantity))
                {
                    $fail('quantity field cannot be empty');
                }
                
                if(empty($item->expired))
                {
                    $fail('expired field cannot be empty');
                }
                
                if($item->expired < Carbon::now())
                {
                    $fail('the expiry date must be greater than the current date');
                }
            }
            $n = count($arr);
            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    if ($arr[$i]->stock == $arr[$j]->stock) {
                        $stockName = Stock::find($arr[$i]->stock)->name;
                        $fail('You have selected the '.$stockName.' stock more than once');
                    }
                }
            }
        }
            
    }
}
