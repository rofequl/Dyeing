<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'factory_id', 'buyer',
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function order_list()
    {
        return $this->hasMany(Order_list::class, 'buyer_id');
    }
}
