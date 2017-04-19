<?php

namespace App\Http\Controllers;
use App\Site;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\storeSites;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $site = Site::paginate(10);
        return view('site.index',compact('site'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $save = new Site;
        $save->name = $request->name;
        $save->operation_time = $request->operational;
        $save->facility = $request->facility;
        $save->lat = $request->lat;
        $save->lng = $request->lng;
        $save->user_id = Auth::user()->id;
        if ($request->hasFile('picture')) {            
            $file = $request->picture->store('public');
            $save->image = $request->picture->hashName();
            $save->save();            
        }

        return redirect()->route('site.index')->with('success','new public attraction created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Site::findOrFail($id);
        return view('site.show',compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Site::findOrFail($id);
        return view('site.edit',compact('row'));
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
             'facility' => 'required',

         ]);

         $update = Site::findOrFail($id);
         $update->name = $request->name;         
         $update->lat = $request->lat;
         $update->lng = $request->lng;
         $update->facility = $request->facility;
         if ($request->hasFile('picture')) { 
             if($request->oldpic){
              Storage::delete('public/'.$request->oldpic);
            }           
             $file = $request->picture->store('public');
             $update->image = $request->picture->hashName();
        }
        $update->save(); 
        return redirect()->route('site.index')->with('success','site edited succesfully');
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
