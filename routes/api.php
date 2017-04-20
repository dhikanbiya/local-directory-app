    <?php
use App\Http\Controllers;

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
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('v1/fuel', function(Request $request){
$lat = $request->input('lat');
$lng = $request->input('lng');
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
    ->having("distance", "<", "10")
    ->orderBy("distance")
    ->offset(0)
    ->limit(10)
    ->setBindings([$lat, $lng, $lat])
    ->get();
return response()->json(array('status'=>'true','data'=>$records));
})->middleware('ath');


Route::post('v1/office', function(Request $request){
$lat = $request->input('lat');
$lng = $request->input('lng');
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


Route::post('v1/worship', function(Request $request){
$lat = $request->input('lat');
$lng = $request->input('lng');
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

Route::post('v1/restaurant', function(Request $request){
$lat = $request->input('lat');
$lng = $request->input('lng');
$records = 
    Restaurant::select(
        DB::raw("id, name, address, phone, image, lat, lng,( 
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

Route::post('v1/restaurant_menu', function(Request $request){
$restaurant_id = $request->input('restaurant_id');

$records = Menu::where('restaurant_id',$restaurant_id);
if($records->count()>1){
    return response()->json(array('status'=>'true','data'=>$records));
}else{
    return response()->json(array('status'=>'false','data'=>$records));
}

})->middleware('ath');

Route::post('v1/site', function(Request $request){
$lat = $request->input('lat');
$lng = $request->input('lng');
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


Route::post('v1/login', function(Request $request){
	$email = $request->input('email');
	$password = $request->input('password');
    $api_token = $request->header('api_token');

	if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $token = Str::random(20);    
        $update = User::where('email',$email)->firstOrFail();
        $update->api_token = $token;  
        if($update->save()){
            $records = User::where('email', $email)->firstOrFail();
            return response()->json(array('status'=>'true','data'=>$records));    
        }else{
            return response()->json(array('status'=>'true','data'=>array('message'=>'login error')));    
        }
        
    }else{
    	$records=array('message'=>'error, please check your username and password');
    	return response()->json(array('status'=>'false','data'=>$records));
    }
});

Route::post('v1/logout',function(Request $request){

		$api_token = $request->header('token');
	
		$token = Str::random(20);        
		$update = User::where('api_token',$api_token)->firstOrFail();
		$update->api_token = $token;
		if($update->save()){
			return response()->json(array('status'=>'true','data'=>array('message'=>'logout success')));
		}else{
		return response()->json(array('status'=>'false','data'=>array('message'=>'logout failed')));			
		}
})->middleware('ath');

// Route::post('v1/register',function(Request $request){
       
//        $name = $request->input('name');
//        $email = $request->input('email');
//        $password = $request->input('password');        

//         $this->validate($request, [
//             'name' => 'required',
//             'email' => 'bail|required|unique:users',
//             'password' => 'required'
//         ]);

       
//         $token = Str::random(20);        

//         $save = new User;
//         $save->name = $name;
//         $save->password = $password;
//         $save->email = $email;
//         $save->api_token = $token;

//         if($save->save()){
//             return response()->json(array('status'=>'true','data'=>array('message'=>'register success')));
//         }else{
//             return response()->json(array('status'=>'false','data'=>array('message'=>'logout failed','error'=>$errors->all())));            
//         }
// });

Route::post('v1/register','ValregController@index');


