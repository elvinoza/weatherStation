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

    /** @var string */
    protected $app_id;
    /** @var string */
    protected $app_key;
    /** @var User */
    protected $user;

    /**
     * @param $app_id
     * @param $app_key
     * @param User $user
     */
    public function __construct($app_id, $app_key, User $user)
    {
        $this->app_id = $app_id;
        $this->app_key = $app_key;
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function authenticate(){
        $this->user = $this->user->find($this->app_id);
        if($this->user != null)
            if(($this->user->id == $this->app_id) && ($this->user->app_key == $this->app_key)){
                return true;
            }
            else return false;
        else return false;
    }

    /**
     * @param $temperature
     * @param $humidity
     * @param $light_level
     * @param $pressure
     * @param $wind_direction
     * @param $wind_speed
     * @param $rain
     */
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

    /**
     * @return array|mixed
     */
    public function getAllData(){
        $this->user = $this->user->find($this->app_id);
        if($this->user != null){
            return $weathers = $this->user->weathers;
        }
        else {
            return array('success' => false, 'error' => 'Station not found');
        }
    }

    /**
     * @param $start_date
     * @param $end_date
     * @param $group
     * @return array
     */
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

    /**
     * @param $format
     * @param $option
     * @return array
     */
    public function getStationDataByFormat($format, $option)
    {
        $this->user = $this->user->find($this->app_id);
        if($this->user != null)
        {
            $data = [];
            if($format == "h"){
                $data = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subHour())
                                ->select([$option, DB::raw("DATE_FORMAT(created_at, '%H:%i') as date")])->get();
            }
            else if($format == "m"){
                $data = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subMonth())
                                ->select([DB::raw("AVG($option) as $option"), DB::raw("DATE_FORMAT(created_at, '%m-%d') AS date")])

                                ->groupBy('date')
                                ->get();
            }
            else if($format == "d"){
                $data = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subDay())
                                ->select([DB::raw("AVG($option) as $option"), DB::raw("DATE_FORMAT(created_at, '%m-%d %Hh') AS date")])
                                ->groupBy('date')
                                ->get();
            }
            else if($format == "w"){
                $data = $this->user->weathers()
                                ->where('created_at', '>=', Carbon::now()->subWeek())
                                ->select([DB::raw("AVG($option) as $option"), DB::raw("DATE_FORMAT(created_at, '%m-%d') AS date")])
                                ->groupBy('date')
                                ->get();
            }
            return array('success' => true, 'data' => $data);
        } else {
            return array('success' => false, 'error' => 'Station not found');
        }
    }

    /**
     * @return array
     */
    public function getLastInformation(){
        $this->user = $this->user->find($this->app_id);
        if($this->user != null){
            if(count($this->user->weathers)){
                $information = $this->user->weathers->last();
                $information->wind_direction = $this->getWindDirectionName($information->wind_direction);
                return array('success' => true, 'information' => $information);
            }
            else{
                return array('success' => false, 'error' => "This station haven't information.");
            }
        }
        else {
            return array('success' => false, 'error' => 'Station not found.');
        }
    }

    /**
     * @param $length
     * @return string
     */
    public function regenerateKey($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $direction
     * @return string
     */
    public function getWindDirectionName($direction){
        $direction_name = "";
        switch($direction){
            case 0:
                $direction_name = "N";
                break;
            case 360:
                $direction_name = "N";
                break;
            case 45:
                $direction_name = "NE";
                break;
            case 90:
                $direction_name = "E";
                break;
            case 135:
                $direction_name = "SE";
                break;
            case 180:
                $direction_name = "S";
                break;
            case 225:
                $direction_name = "SW";
                break;
            case 270:
                $direction_name = "W";
                break;
            case 315:
                $direction_name = "NW";
                break;
        }
        return $direction_name;
    }
}