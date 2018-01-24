<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ActivationController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function activate(){

        $image_id = Input::get('id');

        DB::table('resources')
                ->where('id', $image_id)
                ->update(['active' => 1]);

        return Redirect::back();
    }

    public function dacetivate(){

        $image_id = Input::get('id');
        
        DB::table('resources')
                ->where('id', $image_id)
                ->update(['active' => 0]);

        return Redirect::back();
    }
}