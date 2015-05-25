<?php namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required|min:8',
            'new_password' => 'required|confirmed|min:8'
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


    /**
     * Error messages
     * @return array
     */
    public function messages(){
        return array(
            'current_password.required' => 'Būtina įvesti seną slaptažodį norint jį pakeisti.',
            'current_password.min' => 'Slaptažodis turi būti ilgesnis nei 8 simboliai.',
            'new_password.required' => 'Būtina įvesti naują slaptažodį norint pakeisti senajį.',
            'new_password.min' => 'Naujas slaptažodis turi būti ilgesnis nei 8 simboliai.',
            'new_password.confirmed' => 'Naujas slaptažodis pakartotas neteisingai.'
        );
    }
}