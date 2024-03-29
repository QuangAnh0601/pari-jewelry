<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'create_by',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
}
