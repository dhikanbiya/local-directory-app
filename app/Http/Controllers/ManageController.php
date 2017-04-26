<?php

namespace App\Http\Controllers;
use Auth;
use App\Manage;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Manage::where('web',1)->where('id','<>',Auth::user()->id)->get();
        return view('manage.index',compact('user'))->with('i');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('manage.edit');

    }
    
    public function updatePass(Request $request)
    {
	$this->validate($request,[
        'password' => 'required|min:5',
        'passconf' => 'required|min:5|same:password',        
        ]);
	
       $id = Auth::user()->id;
       $update = Manage::findOrFail($id);
       $update->password = bcrypt($request->newpass);
       $update->save();

       return redirect()->route('home')->with('success','password updated');


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
        $update = Manage::findOrFail($id);
        $update->active = $request->up;
        $update->save();

        return redirect()->route('manage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manage::findOrFail($id)->delete();
        return redirect()->route('manage.index');
    }
}
