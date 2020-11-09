<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{

    public function process_list()
    {
        return $this->hasOne(Process_list::class, 'batch_id');
    }

    public function finished()
    {
        return $this->hasMany(Finished::class, 'batch_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function batchlist()
    {
        return $this->hasMany(BatchList::class, 'batch_id');
    }
}
