<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sponsorship extends Model
{
  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
