<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Restaurant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\storeRestaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = Restaurant::find($id)->menu;
        return view('menu.show',compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Menu::findOrFail($id);
        return view('menu.edit',compact('row'));
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
             'price' => 'required',             
             'picture' => 'mimes:jpeg,jpg,png',
             
         ]);

         $update = Menu::findOrFail($id);
         $update->name = $request->name;         
         $update->price = $request->price;                  
         if ($request->hasFile('picture')) { 
             Storage::delete('public/'.$request->oldpic);           
             $file = $request->picture->store('public');
             $update->image = $request->picture->hashName();
        }
        $update->save(); 
        return redirect()->route('menu.show',$request->resto)->with('success','menu edited succesfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Site::findOrFail($id)->delete();
        return view('restaurant.show')->with('success','delete success');
    }
}
