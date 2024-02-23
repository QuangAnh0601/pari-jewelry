<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descripttion',
        'fee',
        'create_by',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
}
