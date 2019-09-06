<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $fillable = ['wifi', 'parking' , 'pool', 'concierge', 'sauna', 'sea_view'];
  public function flats()
  {
    return $this->belongsTo(Flat::class, 'flat_id');
  }
}
