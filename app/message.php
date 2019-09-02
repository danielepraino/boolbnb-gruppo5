<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public function flats()
  {
    return $this->belongsTo(Flat::class, 'flat_id');
  }
}
