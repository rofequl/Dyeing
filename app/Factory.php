<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $fillable = [
        'factory_name', 'phone', 'address',
    ];

    public function buyer()
    {
        return $this->hasMany(Buyer::class, 'factory_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'factory_id');
    }
}
