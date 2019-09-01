<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flat extends Model
{
    protected $fillable = ['title', 'room', 'bed', 'bathroom', 'sm', 'address', 'image', 'visible', 'lon', 'lat', 'price', 'user_id' ];
}
