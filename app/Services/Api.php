<?php
/**
 * Created by PhpStorm.
 * User: elvinas
 * Date: 3/9/15
 * Time: 9:27 PM
 */
namespace App\Services;

use App\User;
use App\Weather;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Api {

    protected $app_id;
    protected $app_key;
    protected $user;


    public function __construct($app_id, $app_key, User $user)
    {
        $this->app_id = $app_id;
        $this->app_key = $app_key;
        $this->user = $user;
    }

    public function authenticate(){
        $this->user = $this->user->find($this->app_id);
        if($this->user != null)
            if(($this->user->id == $this->app_id) && ($this->user->app_key == $this->app_key)){
                return true;
            }
            else return false;
        else return false;
    }

    public function insertStationData($temperature, $humidity, $light_level, $pressure, $wind_direction, $wind_speed, $rain){
        $weather = new Weather(array(
            'temperature'     => $temperature,
            'humidity'        => $humidity,
            'light_level'     => $light_level,
            'pressure'         => $pressure,
            'wind_direction'  => $wind_direction,
            'wind_speed'      => $wind_speed,
            'rain'            => $rain
        ));
        $this->user->weathers()->save($weather);
    }

    public function getAllData(){
        $this->user = $this->user->find($this->app_id);
        if($this->user != null){
            return $weathers = $this->user->weathers;
        }
        else {
            return array('success' => 'false', 'error' => 'Station not found');
        }
    }

    public function getDataByDate($start_date, $end_date, $group)
    {
        $this->user = $this->user->find($this->app_id);
        if($this->user != null){
            $w = $this->user->weathers()->where('created_at', '>=', $start_date )->Where('created_at', '<=', $end_date)->get();
//            $weathers = $this->user->whereHas('weathers', function($q){
//                $q->where('temperature', '=', 1.10);
//            })->get();
//            return $weathers;
            return $w;
        } else {
            return array('success' => 'false', 'error' => 'Station not found');
        }

    }

    public function getStationTemp($format)
    {
        $this->user = $this->user->find($this->app_id);
        if($this->user != null)
        {
            if($format == "h"){
                $t = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subHour())
                                ->select(['temperature', DB::raw("DATE_FORMAT(created_at, '%h:%i') as date")])->get();
                return $t;
            }
            else if($format == "m"){
                $t = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subMonth())
                                ->select([DB::raw('AVG(temperature) as temperature'), DB::raw('DAY(created_at) AS date')])
                                ->groupBy('date')
                                ->get();
                return $t;
            }
            else if($format == "d"){
                $t = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subDay())
                                ->select([DB::raw('AVG(temperature) as temperature'), DB::raw('HOUR(created_at) AS date')])
                                ->groupBy('date')
                                ->get();
                return $t;
            }
            else if($format == "w"){
                $t = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subWeek())
                                ->select([DB::raw('AVG(temperature) as temperature'), DB::raw('DAY(created_at) AS date')])
                                ->groupBy('date')
                                ->get();
                return $t;
            }

        } else {
            return array('success' => 'false', 'error' => 'Station not found');
        }
    }

    public function regenerateKey($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}