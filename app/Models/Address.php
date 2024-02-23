<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'address',
        'ward',
        'district',
        'city',
        'is_default'
    ];

    public function customer ()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($address) {
            if ($address->is_default) {
                // Set is_default=false for all other addresses of the customer
                $address->customer->addresses()->where('id', '<>', $address->id)->update(['is_default' => false]);
            }
        });
    }

    protected function isDefault(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'yes' : 'no',
            set: fn (string $value) => $value ==  'yes' ? 1 : 0,
        );
    }
}
