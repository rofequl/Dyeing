<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveries_list extends Model
{
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
