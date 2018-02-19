<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('screen/{screen_id}', function (Request $request, $screen_id) {
    return view('screen',["screen_id" => $screen_id]);
})->where('id', '[0-9]+');

//Ajex
Route::post('screen/{screen_id}', 'PictureController@getResourcesForScreen')->where('id', '[0-9]+');





/*******************************************
Screens Setting
********************************************/

Route::get('setting', 'SettingController@render');

//Activation for images
Route::post('setting/activate', 'ActivationController@activate');
Route::post('setting/deactivate', 'ActivationController@dacetivate');

//Upload new images
Route::post('setting/upload', 'PictureController@upload');
//Delete image
Route::post('setting/delete', 'PictureController@delete');




/*******************************************
Temporary routing
********************************************/
// Route::get('proj/hans/screen/{screen_id}', function(Request $request, $screen_id){
// 	return redirect('screen/'.$screen_id);
// })->where('id', '[0-9]+');