<?php

namespace App\Http\Controllers;
use App\Worship;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\storeWorships;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class WorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worship = Worship::paginate(10);
        return view('worship.index',compact('worship'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('worship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeWorships $request)
    {
        $save = new Worship;
        $save->name = $request->name;        
        $save->address = $request->address;
        $save->lat = $request->lat;
        $save->lng = $request->lng;
        $save->religion_type = $request->rel;
        $save->user_id = Auth::user()->id;
        if ($request->hasFile('picture')) {            
            $file = $request->picture->store('public');
            $save->image = $request->picture->hashName();
            $save->save();            
        }

        return redirect()->route('worship.index')->with('success','new public attraction created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Worship::findOrFail($id);
        return view('worship.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    
        $row = Worship::findOrFail($id);
        return view('worship.edit',compact('row'));
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
             'lat' => 'required',
             'lng' => 'required',
             'picture' => 'mimes:jpeg,jpg,png',
             'address' => 'required',
             'rel' => 'required',

         ]);

         $update = Worship::findOrFail($id);
         $update->name = $request->name;         
         $update->lat = $request->lat;
         $update->lng = $request->lng;
         $update->religion_type = $request->rel;
         $update->address = $request->address;
         if ($request->hasFile('picture')) { 
             Storage::delete('public/'.$request->oldpic);           
             $file = $request->picture->store('public');
             $update->image = $request->picture->hashName();
        }
        $update->save(); 
        return redirect()->route('worship.index')->with('success','site edited succesfully');
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
        return view('site.index')->with('success','delete success');
    }
}
