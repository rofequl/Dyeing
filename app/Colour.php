<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    protected $fillable = [
        'colour_name',
    ];

    public function order_list()
    {
        return $this->hasMany(Order_list::class, 'colour_id');
    }
}
