<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function colour()
    {
        return $this->belongsTo(Colour::class);
    }

    public function grey()
    {
        return $this->hasMany(Grey::class, 'order_list_id');
    }

    public function lab()
    {
        return $this->hasMany(Lab::class, 'order_list_id');
    }

    public function batchlist()
    {
        return $this->hasMany(BatchList::class, 'order_list_id');
    }
}
