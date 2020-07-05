<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $user =  DB::table("users")->where("id", Auth::user()->id)->get();
        return view('profile.edit',compact('user'));
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
    public function edit($id)
    {
        //
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'avatar' => 'sometimes|mimes:jpeg,jpg,png|max:5000'
        ]);
        //file upload
        if ($request->hasfile('photo')) { //take photo from input
            $image = $request->file('photo'); //take the file
            $name = $image->getClientOriginalName(); //take img name
            $image->move(public_path().'/image/',$name); //store in image folder
            $photo = '/image/'.$name;
        }else{
            $photo = request('oldimg');
        }

        if(request('password')){
            $password = request('password');
        }
        else{
            $password = request('oldpassword');
        }
        //data update
        $profile = User::find($id);
        $profile->name = request('name');
        $profile->email = request('email');
        $profile->avatar = $photo;
        $profile->password = Hash::make($password);

        $profile->save();
        //redirect
        return redirect()->route('profile.index', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
