<?php

namespace App\Http\Controllers;

use App\Langage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LangageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $langages = Langage::all();
        return response()->json($langages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'string|required | unique:langages|max:255',
            'imgName' => 'string'
        ]);

        if ($validator->fails()){
            return response()->json([
                "code" => 422,
                'message'   =>  'Error validator']
                ,422);
        }

        Langage::create([
            'name'=>$request['name'],
            'imgName'=>$request['imgName'],
        ]);

        return response()->json('new langage added',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Langage  $langage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(intval($id) == NULL){
            return response()->json(array(
                'code'      =>  400,
                'message'   =>  "Invalid query"
            ), 400);
        }
        elseif(Langage::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $langage =  Langage::whereId($id)->first();
        return response()->json([
            'code' => 200,
            'result' => $langage],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Langage  $langage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(intval($id) == NULL){
            return response()->json(array(
                'code'      =>  400,
                'message'   =>  "Invalid query"
            ), 400);
        }
        elseif(Langage::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'string',
            'imgName' => 'string',
        ]);
        if ($validator->fails()){
            return response()->json([
                'code'      =>  422,
                'message'   =>  'Error validator']
                ,422);
        }


        $langage = Langage::whereId($id)->first();
        $langage->update([
            'name'=>$request['name'],
            'imgName'=>$request['imgName'],
        ]);

        return response()->json('Update langage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Langage  $langage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $langage = Langage::whereId($id)->first();
        if ($langage == null) {
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $langage->delete();
        return response()->json('Langage nb='.$id.' deleted');

    }

}
