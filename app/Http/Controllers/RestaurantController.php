<?php

namespace App\Http\Controllers;

use Auth;
use App\Restaurant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\storeRestaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resto = Restaurant::paginate(10);
        return view('restaurant.index',compact('resto'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeRestaurant $request)
    {
        $save = new Restaurant;
        $save->name = $request->name;
        $save->address = $request->address;
        $save->phone = $request->phone;
        $save->lat = $request->lat;
        $save->lng = $request->lng;        
        $save->promotion = $request->promotion;        
        $save->user_id = Auth::user()->id;

         if ($request->hasFile('picture')) {            
             $file = $request->picture->store('public');
             $save->image = $request->picture->hashName();
             $save->save();            
         }

         return redirect()->route('restaurant.index')->with('success','new gas station created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Restaurant::findOrFail($id);
        return view('restaurant.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $row = Restaurant::findOrFail($id);
       return view('restaurant.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
             'name' => 'required',
             'address' => 'required',             
             'lat' => 'required',
             'lng' => 'required',
             'picture' => 'mimes:jpeg,jpg,png',             

         ]);

         $update = Restaurant::findOrFail($id);
         $update->name = $request->name;
         $update->address = $request->address;
         $update->phone = $request->phone;
         $update->promotion = $request->promotion;
         $update->lat = $request->lat;
         $update->lng = $request->lng;        
         if ($request->hasFile('picture')) { 
             Storage::delete('public/'.$request->oldpic);           
             $file = $request->picture->store('public');
             $update->image = $request->picture->hashName();
        }
        $update->save(); 
        return redirect()->route('restaurant.index')->with('success','restaurant edited succesfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Office::findOrFail($id)->delete();
       return redirect()->route('restaurant.index')->with('success','delete success');
    }
}
