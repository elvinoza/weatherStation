<?php namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisteRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'station_name' => 'required|unique:users|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
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
            'station_name.unique' => 'Toks stotelės varadas jau egzistuoja. Pabandykite kitą!',
            'station_name.required' => 'Būtina įvesti stotelės vardą!',
            'station_name.min' => 'Stotelės vardo ilgis turi būti ilgesnis, nei 3 simboliai.',
            'email.required' => 'Būtina įvesti elektorninį paštą.',
            'email.email' => 'Neteisingas elektroninis paštas. Turi būti example@pvz.lt',
            'email.unique' => 'Tokiu elektroniniu parštu jau yra užregistruota stotelė.',
            'password.required' => 'Būtina įvesti slaptažodį.',
            'password.confirmed' => 'Slaptažodis turi būti patvirtintas.',
            'password.min' => 'Slaptažodis turi būti ilgesnis, nei 8 simboliai.',
        );
    }
}