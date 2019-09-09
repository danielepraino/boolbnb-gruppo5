<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Flat extends Model implements ViewableContract
{
    use Viewable;

    protected $fillable = ['title', 'description' , 'room', 'bed', 'bathroom', 'sm', 'address', 'image', 'visible', 'lon', 'lat', 'price', 'user_id' ];
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
        return $this->hasOne(Service::class);
    }
}
