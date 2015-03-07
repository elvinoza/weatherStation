<?php
/**
 * Created by PhpStorm.
 * User: elvinas
 * Date: 3/6/15
 * Time: 4:09 PM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

class DeveloperController extends Controller {



    public function index()
    {
        return View('developer.index');
    }

    public function dashboard()
    {
        return view('developer.dashboard');
    }

}