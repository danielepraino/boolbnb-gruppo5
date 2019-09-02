<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = ['title', 'room', 'bed', 'bathroom', 'sm', 'address', 'image', 'visible', 'lon', 'lat', 'price', 'user_id' ];
    public function users()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
