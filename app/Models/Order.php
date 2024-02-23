<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'customer_id',
        'total_price',
        'order_date',
        'shipping_address',
        'payment_id',
        'ship_id',
        'status',
        'coupon_code',
        'company',
        'country',
        'postal_code',
        'full_name',
        'email',
        'phone_number',
        'note',
    ];

    public function payment ()
    {
        return $this->belongsTo(Payment::class);
    }

    public function ship ()
    {
        return $this->belongsTo(Ship::class);
    }

    public function coupon ()
    {
        return $this->belongsTo(Coupon::class, 'coupon_code', 'code');
    }

    public function orderDetails ()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer ()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function createBy ()
    {
        return $this->morphTo();
    }

    
    public function routeNotificationForMail()
    {
        return $this->email;
    }

}
