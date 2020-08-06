<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tuto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TutoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        Tuto::create([
            'title'=>$request['title'],
            'difficulty'=>$request['difficulty'],
            'langage'=>$request['langage'],
            'state'=>$request['state'],
            'author_id'=>$request['author_id'],

            'summary'=>$request['summary'],
            'content'=>$request['content'],
            'pathImg'=>$request['pathImg'],
            'ratings'=>$request['ratings'],
            'nb_ratings'=>$request['nb_ratings'],
            'files'=>$request['files'],
        ]);
        return response()->json('Tuto create');
    }

    function index(Request $request){
        $tutos =  Tuto::all();
        return response()->json($tutos);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id Tuto
     * @return \Illuminate\Http\Response
     */
    function show($id){
        $tutos =  DB::table('tutos')->whereId($id)->first();
        return response()->json($tutos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tuto  $tuto
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id){
        $tuto = Tuto::whereId($id)->first();
        $tuto->update([
            'title'=>$request['title'],
            'difficulty'=>$request['difficulty'],
            'langage'=>$request['langage'],
            'state'=>$request['state'],
            'summary'=>$request['summary'],
            'content'=>$request['content'],
            'pathImg'=>$request['pathImg'],
            
            'files'=>$request['files'],
        ]);
        return response()->json('Update tuto');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tuto  $tuto
     * @return \Illuminate\Http\Response
     */
    function destroy( $id){
        $tuto = Tuto::whereId($id)->first();
        $tuto->delete();
        return response()->json('Tuto deleted');

    }
}
