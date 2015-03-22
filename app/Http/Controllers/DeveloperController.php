<?php
/**
 * Created by PhpStorm.
 * User: elvinas
 * Date: 3/6/15
 * Time: 4:09 PM
 */
namespace App\Http\Controllers;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Auth\UpdateUserInfoRequest;
use App\User;

class DeveloperController extends Controller {

    protected $user;

    public function __construct(User $user){
        if(Auth::check())
            $this->user = $user->find(Auth::user()->id);
        else
            $this->user = Auth::user();
    }

    public function index()
    {
        return View('developer.index');
    }

    public function updateForm()
    {
        $user = $this->user;

        return view('developer.update', ['user' => $user]);
    }

    public function updateInfo(UpdateUserInfoRequest $request){
        $this->user->station_name = $request->station_name;
        $this->user->email = $request->email;
        $this->user->save();
        return redirect()->route('developer.station');
    }

    public function changePassword(ChangePasswordRequest $request){

        if(Hash::check($request->current_password, $this->user->password))
        {
            $this->user->password = bcrypt($request->new_password);
            $this->user->save();
            return redirect()->route('developer.station')->with(['successful' => 'Password changed!']);
        }
        return redirect()->route('developer.station')->withErrors([
            'email' => 'You entered wrong password!'
        ]);
    }

    public function regenerateAppKey(Request $request){
        $generated = true;
        $new_key = "";
        while($generated){
            $new_key = $this->generateKey(32);
            if(User::where('app_key', '=', $new_key)->count() == 0){
                $this->user->app_key = $new_key;
            }
            $generated = false;
        }
        return redirect()->route('developer.update');
    }

    public function getStationData(){
        dd($this->user->weathers);
    }
}