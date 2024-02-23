<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Coupon extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'out_of_date',
        'discount_percent',
        'status',
        'create_by',
        'code',
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['code'];
    }

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function orders ()
    {
        return $this->hasMany(Order::class, 'coupon_code');
    }
}
