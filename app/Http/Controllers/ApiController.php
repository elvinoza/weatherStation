<?php
/**
 * Created by PhpStorm.
 * User: elvinas
 * Date: 3/8/15
 * Time: 1:46 PM
 */

namespace App\Http\Controllers;

use App\Services\Api;
use App\User;
use App\Weather;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller {

    protected $user;

    //protected $api;

    public function __construct(User $user)
    {
        $this->user = $user;
        //$this->api = $api;
    }

    public function insert(){
        //$app_id = Input::get('app_id');
        //$app_key = Input::get('app_key');

        $api = new Api("3RkTSJ", "KjdTEANlw6YPxKIPORINgmMKzQBTJtDt", $this->user);

        if($api->authenticate()){
            $api->insertStationData(Input::get('t'), Input::get('h'), Input::get('l'),
                Input::get('p'), Input::get('wd'), Input::get('ws'), Input::get('r'));
            return response()->json(array('success'=>'true', 'message' => 'Successful authenticated'));
        }
        else {
            return response()->json(array('success'=>'false', 'message' => 'Authenticate problem. Check your app_id and app_key or generate new.'));
        }
    }

    public function getAllData($id)
    {
        $api = new Api($id, null, $this->user);
        $weathers = $api->getAllData();
        return response()->json($weathers);
    }

    public function getByDate($id, $startDate, $endDate, $groupBy = "all")
    {
        $api = new Api($id, null, $this->user);
        $q = $api->getDataByDate($startDate,$endDate, $groupBy);
        dd($q);
    }

    public function getStations()
    {
        return response()->json($this->user->all(['id', 'station_name']));
    }

    public function tryy(){
        return response()->json(['a'=>'b']);
    }
}