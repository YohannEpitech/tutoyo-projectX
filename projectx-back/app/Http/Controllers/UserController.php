<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tuto;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    function register(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|string| max:255',
            'email' => 'required',
            'password' => 'required',

        ]);
        if ($validator->fails()){
            return response()->json([
                'code'      =>  422,
                'message'   =>  'Error validator in register']
                ,422);
        }

        $newUser =User::create([
            'name'=> $request['username'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
            'follow_tutos' => serialize([1,2])
        ]);
        return response()->json([
            "message" => 'User create',
            "code" => 201,
            'user' => $newUser]
            ,201);
    }

    function login(Request $request){
        $credentials=$request->only('email','password');

        if (Auth::attempt($credentials)){
            $user =  DB::table('users')->whereId(Auth::user()->id)->first();
            $user->follow_tutos = unserialize($user->follow_tutos);

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
        if(intval($id) == NULL){
            return response()->json(array(
                'code'      =>  400,
                'message'   =>  "Invalid query"
            ), 400);
        }
        elseif(User::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $user =  DB::table('users')->whereId($id)->first();
        $user->follow_tutos = unserialize($user->follow_tutos);
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
        if(intval($id) == NULL){
            return response()->json(array(
                'code'      =>  400,
                'message'   =>  "Invalid query"
            ), 400);
        }
        elseif(User::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $validator = Validator::make($request->all(),[
            'username' => 'string| max:255',
            'email' => 'email address',
        ]);
        if ($validator->fails()){
            return response()->json([
                'code'      =>  422,
                'message'   =>  'Error validator in update']
                ,422);
        }

        $user =  User::whereId($id)->first();
        if ($request['username'] != ''){
            $user->name = $request['username'];
        }
        if ($request['follow_tutos'] != null){
            $user->follow_tutos = serialize($request['follow_tutos']);
        }
        $user->save();

        return response()->json([
            "code" => 201,
            "message" => 'User successfully updated'
        ],201 );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    function destroy($id_user){
        $user = User::whereId($id_user)->first();
        if ($user == null) {
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $user->delete();
        return response()->json('User successfully deleted');

    }

    function myTutos($id){
        $idUser = $id;
        $user = User::whereId($idUser)->first();
        if ($user->role == 1){
            $tutos = Tuto::where('author_id','=',$idUser)->get();
        } elseif ($user->role == 0){
            $followedTutos = unserialize($user->follow_tutos);
            $tutos=[];
            foreach ($followedTutos as $tuto){
                $tutos[] =intval(Tuto::where('id','=',$tuto)->first()->id);
            }
        }
        return response()->json($tutos);

    }

    function add(Request $request){

        $idUser = intval($request['me']);
        $idTuto = intval($request['addTutoId']);
        $user = User::whereId($idUser)->first();

        $followedTutos = unserialize($user->follow_tutos);
        if (!in_array($idTuto, $followedTutos)){
            $followedTutos[]=$idTuto;
        }
        $user->follow_tutos = serialize($followedTutos);
        $user->save();
        $user->follow_tutos = unserialize($user->follow_tutos);

        return response()->json($user);

    }
    function del(Request $request){
        $idUser = $request['me'];
        $idTuto = $request['delTutoId'];

        $user = User::whereId($idUser)->first();

        $followedTutos = unserialize($user->follow_tutos);
        if ($index = array_search($idTuto, $followedTutos)){
            array_splice($followedTutos,$index,1);
        }
        $user->follow_tutos = serialize($followedTutos);
        $user->save();
        $user->follow_tutos = unserialize($user->follow_tutos);

        return response()->json($user);

    }
}
