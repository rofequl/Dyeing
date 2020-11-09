<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchList extends Model
{
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function order_list()
    {
        return $this->belongsTo(Order_list::class);
    }
}
