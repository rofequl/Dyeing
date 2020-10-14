<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finished extends Model
{
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
