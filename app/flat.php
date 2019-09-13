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


    public static function filterByRadius($flats, $radius, $userLat, $userLon){
      $flat_filtered_by_radius = [];

        for ($i = 0; $i < count($flats); $i++) {
           $currentLat = $flats[$i]->lat;
           $currentLon = $flats[$i]->lon;
           $distanza = Flat::getDistance($userLat,$userLon,$currentLat,$currentLon);
          if($distanza < $radius ) {
            array_push($flat_filtered_by_radius, $flats[$i]);
          }
        }

      return $flat_filtered_by_radius;
    }

    public static function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo){
      $earthRadius = 6372.8;

      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($latitudeTo);
      $lonTo = deg2rad($longitudeTo);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      return $angle * $earthRadius;
    }
}
