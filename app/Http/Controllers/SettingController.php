<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function render(){

        $screens = DB::table('screen')->get();
        $images = DB::table('resources')->get();

        return view('setting', ['screen_info' => $screens,'image_info' => $images]);
    }


  
}