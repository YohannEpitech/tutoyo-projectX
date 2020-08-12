<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tuto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class TutoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'string|required | unique:tutos|max:255',
            'difficulty' => 'required',
            'langage' => 'required',
            'state' => 'integer|required',
            'author_id' => 'integer|required',
            'summary' => 'string|required',
            'content' => 'string|required',
        ]);
        if ($validator->fails()){
            return response()->json([
                "code" => 422,
                'message'   =>  'Error validator']
                ,422);
        }


        $newEntry = Tuto::create([
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

        return response()->json('new_entry = '.$newEntry->id,201);
    }

    function index(){
        $tutos =  Tuto::all();
        foreach ($tutos as $tuto){
            $tuto['authorName'] =  DB::table('users')->whereId($tuto->author_id)->first()->name;
        }
        return response()->json($tutos);
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
        elseif(Tuto::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
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
        if(intval($id) == NULL){
            return response()->json(array(
                'code'      =>  400,
                'message'   =>  "Invalid query"
            ), 400);
        }
        elseif(Tuto::whereId($id)->first() == null){
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $validator = Validator::make($request->all(),[
            'title' => 'string|max:255',
            'difficulty' => '',
            'langage' => 'string',
            'state' => 'integer',
            'summary' => 'string',
            'content' => 'string',

        ]);
        if ($validator->fails()){
            return response()->json([
                'code'      =>  422,
                'message'   =>  'Error validator']
                ,422);
        }
        // $tmp= $this->storeImage($request);
        $tuto = Tuto::whereId($id)->first();
        $tuto->update([
            'title'=>$request['title'],
            'difficulty'=>$request['difficulty'],
            'langage'=>$request['langage'],
            'state'=>$request['state'],
            'summary'=>$request['summary'],
            'content'=>$request['content'],
            'pathImg'=>$request['pathImg'],
            // 'files'=>$tmp,
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
        if ($tuto == null) {
            return response()->json(array(
                'code'      =>  404,
                'message'   =>  "Ressource not found"
            ), 404);
        }
        $tuto->delete();
        return response()->json('Tuto nb='.$id.' deleted');

    }

    function storeImage(Request $request){
        $file = $request->file('files');
        $file->storeAs('/uploads/','test.png','uploads');
        // return File::create(['file_name' => $fileName, 'path' => $filePath, 'file_extension' => $file->getClientOriginalExtension()]);
    }

    function search(Request $request){
        $tutos =  Tuto::where('title','like','%'.$request['searchField'].'%')->get();

        if (count($tutos) ==0){
            return response()->json([
                "code" => 200,
                "messages"=> 'Result for '.$request['searchField'],
                "result" => 'No result for you']
            );
        }

        foreach ($tutos as $tuto){
            $tuto['authorName'] =  DB::table('users')->whereId($tuto->author_id)->first()->name;
        }
        return response()->json([
            "code" => 200,
            "messages"=> 'Result for '.$request['searchField'],
            "result" => $tutos]);
    }
}
