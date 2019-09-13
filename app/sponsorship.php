<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
  protected $fillable = ['duration', 'price', "flat_id"];

  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
