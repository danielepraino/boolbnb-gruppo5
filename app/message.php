<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [ 'sender', 'subject', 'message', 'flat_id'];

  public function flats()
  {
    return $this->belongsTo(Flat::class, 'flat_id');
  }
}
