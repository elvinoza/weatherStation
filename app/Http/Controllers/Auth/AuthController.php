<?php namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisteRequest;

class AuthController extends Controller {

    /**
     * the model instance
     * @var User
     */
    protected $user;
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;

        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisteRequest  $request
     * @return Response
     */
    public function postRegister(RegisteRequest $request)
    {
        $api_credentials = true;
        while ($api_credentials){
            $app_id = $this->generateKeyAndID(6);
            $app_key = $this->generateKeyAndID(32);

            if(is_null($this->user->where('app_id', '=', $app_id)->where('app_key', '=', $app_key))){
                $api_credentials = true;
            }
            else $api_credentials = false;
        }
        $this->user->id = $app_id;
        $this->user->app_key = $app_key;
        $this->user->station_name = $request->station_name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        $this->auth->login($this->user);
        return redirect()->route('developer.sign-in');
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        if ($this->auth->attempt($request->only('email', 'password')))
        {
            return redirect()->route('developer.index');
        }

        return redirect()->route('developer.sign-in')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->route('developer.index');
    }

    /**
     * This function generate random app_key and app_id
     * @param Integer
     * @return String
     */
    public function generateKeyAndID($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function dashboard()
    {
        var_dump("asd");
        return view('developer.dashboard');
    }

}