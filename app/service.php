<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  public function flats()
  {
    return $this->belongsTo(Flat::class, 'flat_id');
  }
}
