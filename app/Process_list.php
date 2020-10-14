<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process_list extends Model
{
    protected $fillable = ['process_id', 'batch_id'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
