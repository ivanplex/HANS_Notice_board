<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PictureController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function getResourcesForScreen(Request $request, $screen_id){

        $pictures = DB::table('resources')
                ->where('screen', $screen_id)
                ->where('active', '1')
                ->get();

        // return view('screen', ['picture' => $pictures]);
        // return Response::json($pictures);
        return $pictures;
    }


    public function upload(Request $request){

        $input = Input::all();
        $rules = array(
            // 'file' => 'image|max:3000',
            'imagefile' => 'required|image',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors->first(), 400);
        }


        $image_uploaded = Storage::putFile('public/images', $request->file('imagefile'));
        Storage::setVisibility($image_uploaded, 'public');  //Set visible
        
        DB::table('resources')->insert([
            'screen' => $input['for_screen_id'],
            'name' => $input['image_description'],
            'path' => $image_uploaded,
            'active' => '0'
            ]);

        if( $image_uploaded ) {
            return redirect('setting')
            ->with('status', 200)
            ->with('style', 'success')
            ->with('action', 'Upload')
            ->with('message', 'Your image will appear under the corresponding tab.');
        } else {
            return redirect('setting')
            ->with('status', 400)
            ->with('style', 'danger')
            ->with('action', 'Upload')
            ->with('message', 'Please try again or alternatively you can contact your system administrator.');
        }
    }

    public function delete(Request $request){

        $input = Input::all();

        $image_json = DB::table('resources')
                    ->where('id', $input['image_id'])
                    ->get();

        $image = json_decode($image_json, true);

        //Remove image file
        Storage::delete($image[0]['path']);

        DB::table('resources')
                    ->where('id', $input['image_id'])
                    ->delete();


        if( $image ) {
            return redirect('setting')
            ->with('status', 200)
            ->with('style', 'success')
            ->with('action', 'Remove')
            ->with('message', '');
        } else {
            return redirect('setting')
            ->with('status', 400)
            ->with('style', 'danger')
            ->with('action', 'Remove')
            ->with('message', 'Please try again or alternatively you can contact your system administrator.');
        }
    }
}