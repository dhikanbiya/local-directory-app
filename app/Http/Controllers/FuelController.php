<?php

namespace App\Http\Controllers;

use App\Fuel;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\storeFuels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $fuel = Fuel::paginate(10);
        return view('fuel.index',compact('fuel'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fuel.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeFuels $request)
    {  
       $save = new Fuel;
       $save->name = $request->name;
       $save->address = $request->address;
       $save->lat = $request->lat;
       $save->lng = $request->lng;
       $fuel_type = implode($request->gas,', ');
       $save->fuel_type = $fuel_type;
       $save->user_id = Auth::user()->id;

        if ($request->hasFile('picture')) {            
            $file = $request->picture->store('public');
            $save->image = $request->picture->hashName();
            $save->save();            
        }

        return redirect()->route('fuel.index')->with('success','new gas station created');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Fuel::findOrFail($id);
        return view('fuel.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Fuel::findOrFail($id);
        return view('fuel.edit',compact('row'));
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

         $update = Fuel::findOrFail($id);
         $update->name = $request->name;
         $update->address = $request->address;
         $update->lat = $request->lat;
         $update->lng = $request->lng;        
         if ($request->hasFile('picture')) { 
             Storage::delete('public/'.$request->oldpic);                    
             $file = $request->picture->store('public');
             $update->image = $request->picture->hashName();
        }
        $update->save(); 
        return redirect()->route('fuel.index')->with('success','Gas station edited succesfully'); 
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
        return redirect()->route('fuel.index')->with('success','delete success');
    }
}
