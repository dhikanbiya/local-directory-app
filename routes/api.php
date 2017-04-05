<?php
use App\Fuel;
use App\Office;
use App\Worship;
use App\Site;
use App\Restaurant;
use App\Menu;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/fuel', function(Request $request){
$lat = $request->header('lat');
$lng = $request->header('lng');
$records = 
    Fuel::select(
        DB::raw("name, lat, lng,( 
            6371 * acos( 
                cos( radians(  ?  ) ) *
                cos( radians( lat ) ) * 
                cos( radians( lng ) - radians(?) ) + 
                sin( radians(  ?  ) ) *
                sin( radians( lat ) ) 
            )
       ) AS distance")
    )
    ->having("distance", "<", "5")
    ->orderBy("distance")
    ->offset(0)
    ->limit(10)
    ->setBindings([$lat, $lng, $lat])
    ->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');


Route::get('v1/office', function(Request $request){
$lat = $request->header('lat');
$lng = $request->header('lng');
$records = 
    Office::select(
        DB::raw("name, address, phone, information, image, lat, lng,( 
            6371 * acos( 
                cos( radians(  ?  ) ) *
                cos( radians( lat ) ) * 
                cos( radians( lng ) - radians(?) ) + 
                sin( radians(  ?  ) ) *
                sin( radians( lat ) ) 
            )
       ) AS distance")
    )
    ->having("distance", "<", "10")
    ->orderBy("distance")
    ->offset(0)
    ->limit(10)
    ->setBindings([$lat, $lng, $lat])
    ->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');


Route::get('v1/worship', function(Request $request){
$lat = $request->header('lat');
$lng = $request->header('lng');
$records = 
    Worship::select(
        DB::raw("name, address, religion_type, image, lat, lng,( 
            6371 * acos( 
                cos( radians(  ?  ) ) *
                cos( radians( lat ) ) * 
                cos( radians( lng ) - radians(?) ) + 
                sin( radians(  ?  ) ) *
                sin( radians( lat ) ) 
            )
       ) AS distance")
    )
    ->having("distance", "<", "10")
    ->orderBy("distance")
    ->offset(0)
    ->limit(10)
    ->setBindings([$lat, $lng, $lat])
    ->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');

Route::get('v1/site', function(Request $request){
$lat = $request->header('lat');
$lng = $request->header('lng');
$records = 
    Site::select(
        DB::raw("name, operation_time, facility, image, lat, lng,( 
            6371 * acos( 
                cos( radians(  ?  ) ) *
                cos( radians( lat ) ) * 
                cos( radians( lng ) - radians(?) ) + 
                sin( radians(  ?  ) ) *
                sin( radians( lat ) ) 
            )
       ) AS distance")
    )
    ->having("distance", "<", "10")
    ->orderBy("distance")
    ->offset(0)
    ->limit(10)
    ->setBindings([$lat, $lng, $lat])
    ->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');

Route::get('v1/hello', function(Request $request){
	return response()->json('hi');
})->middleware('ath');

Route::get('v1/restaurant_menu', function(Request $request){
$restaurant_id = $request->header('restaurant_id');
$records = 
    DB::table('menus')->where(
    	'restaurant_id',$restaurant_id
    	)->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');

Route::post('v1/login', function(Request $request){
	
	$email = $request->header('email');
	$password = $request->header('password');
	if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $records = User::where('email', $email)->firstOrFail();
        return response()->json(array('status'=>'true','data'=>$records));
    };
});

