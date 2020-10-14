<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function order_list()
    {
        return $this->belongsTo(Order_list::class);
    }


    public function process_list()
    {
        return $this->hasMany(Process_list::class, 'batch_id');
    }

    public function finished()
    {
        return $this->hasMany(Finished::class, 'batch_id');
    }
}
