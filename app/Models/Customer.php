<?php

namespace App\Models;

use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements AuthenticatableContract, AuthMustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'phone_number',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomerVerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }

    public function addresses ()
    {
        return $this->hasMany(Address::class);
    }

    protected function address (): Attribute
    {
        $address = $this->addresses()->where('is_default', 1)->first();
        return new Attribute(
            get: fn() => isset($address) ? $address->address . ', ' . $address->ward . ', ' . $address->district . ', ' . $address->city : "Customer has no address",
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'customer_product', 'customer_id', 'product_id')->withTimestamps();
    }

    public function cart ()
    {
        return $this->hasOne(Cart::class);
    }

    public function checkWishList ($id)
    {
        return $this->products()->where('products.id', $id)->first();
    }

    public function fullName ()
    {
        $address = $this->addresses()->where('is_default', 1)->first();
        return isset($address) ? $address->full_name : '';
    }

    public function additionalOrders()
    {
        return $this->morphMany(Order::class, 'create_by');
    }

}
