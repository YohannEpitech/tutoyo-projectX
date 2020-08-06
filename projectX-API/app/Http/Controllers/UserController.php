<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    function register(Request $request){
        $username = $request->only('username')['username'];
        $password = $request->only('password')['password'];
        $email = $request->only('email')['email'];

        User::create([
            'name'=>$username,
            'email'=>$email,
            'password'=>Hash::make($password)
        ]);
        return response()->json('User create');
    }

    function login(Request $request){
        $credentials=$request->only('email','password');
        
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            return response()->json($user);
        } 
        return response()->json('User unknown');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id Tuto
     * @return \Illuminate\Http\Response
     */
    function show($id){
        $user =  DB::table('users')->whereId($id)->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        $user =  User::whereId($id)->first();

        if ($request['username'] == ''){
            $request['username'] = $user->name;
        }
        if ($request['follow_tutos'] == ''){
            $request['follow_tutos'] = $user->follow_tutos;
        }
        
        $user->name=$request['username'];
        $user->follow_tutos = $request['follow_tutos'];
        $user->save();

        return response()->json('Update user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    function destroy(User $user){
        // $tuto = Tuto::whereId($id)->first();
        $user->delete();
        return response()->json('Tuto deleted');

    }
}
