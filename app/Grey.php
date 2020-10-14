<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grey extends Model
{
    public function order_list()
    {
        return $this->belongsTo(Order_list::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
