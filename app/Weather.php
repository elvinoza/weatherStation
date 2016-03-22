<?php
namespace App;
/**
 * Created by PhpStorm.
 * User: elvinas
 * Date: 3/8/15
 * Time: 12:31 PM
 */

use Illuminate\Database\Eloquent\Model;

class Weather extends Model {

    protected $fillable = ['temperature', 'humidity', 'light_level', 'pressure', 'wind_direction', 'wind_speed',
                           'rain', 'soil_temperature', 'soil_humidity'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}