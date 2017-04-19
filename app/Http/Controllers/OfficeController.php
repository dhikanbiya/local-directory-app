<?php

namespace App\Http\Controllers;
use App\Office;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\valOffice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $office = Office::paginate(10);

        return view('office.index',compact('office'))->with('i');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(valOffice $request)
    {
        $save = new Office;
        $save->name = $request->name;
        $save->address = $request->address;
        $save->phone = $request->phone;
        $save->lat = $request->lat;
        $save->lng = $request->lng;
        $save->information = $request->information;
        $save->user_id = Auth::user()->id;
        if ($request->hasFile('picture')) {            
            $file = $request->picture->store('public');
            $save->image = $request->picture->hashName();
            $save->save();            
        }
        return redirect()->route('office.index')->with('success','new office created');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Office::findOrFail($id);
        return view('office.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Office::findOrFail($id);
        return view('office.edit',compact('row'));
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
            'phone' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'picture' => 'mimes:jpeg,jpg,png',
            'information' => 'required',

        ]);

        $update = Office::findOrFail($id);
        $update->name = $request->name;
        $update->address = $request->address;
        $update->phone = $request->phone;
        $update->lat = $request->lat;
        $update->lng = $request->lng;
        $update->information = $request->information;
        if ($request->hasFile('picture')) { 
           if($request->oldpic){
              Storage::delete('public/'.$request->oldpic);
            }            
            $file = $request->picture->store('public');
            $update->image = $request->picture->hashName();
       }
       $update->save(); 
       return redirect()->route('office.index')->with('success','office edited succesfully');           
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
        return redirect()->route('office.index')->with('success','delete success');
    }
}
