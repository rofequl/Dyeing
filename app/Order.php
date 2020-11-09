<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_list()
    {
        return $this->hasMany(Order_list::class, 'order_id');
    }

    public function grey()
    {
        return $this->hasMany(Grey::class, 'order_id');
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function lab()
    {
        return $this->hasMany(Lab::class, 'order_id');
    }

    public function batch()
    {
        return $this->hasMany(Batch::class, 'order_id');
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'order_id');
    }
}
