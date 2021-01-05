<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveries_list()
    {
        return $this->hasMany(Deliveries_list::class, 'delivery_id');
    }
}
