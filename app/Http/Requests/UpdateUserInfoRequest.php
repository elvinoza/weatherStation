<?php namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserInfoRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(Auth::user()->station_name == $this->input('station_name'))
            $name_id = Auth::user()->id;
        else $name_id = null;

        if(Auth::user()->email == $this->input('email'))
            $email_id = Auth::user()->id;
        else $email_id = null;

        return [
            'station_name' => 'required|min:3|unique:users,station_name,' . $name_id,
            'email' => 'required|email|unique:users,email,'. $email_id
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}