<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $fillable = [
        'style_name',
    ];

    public function order_list()
    {
        return $this->hasMany(Order_list::class, 'style_id');
    }
}
