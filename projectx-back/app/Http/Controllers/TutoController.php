<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tuto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


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
            'state' => 'required',
            'author_id' => 'required',
            'summary' => 'string|max:255',
            'content' => 'string',
            'files'     =>  'mimes:pdf|max:1000'
        ]);
        if ($validator->fails()){
            return response()->json([
                "code" => 422,
                'message'   =>  'Error validator']
                ,422);
        }
        if ($request['files']){
            $img=$request->file('files');
            $name = Str::slug('tuto_'.time());
            $folder = '/uploads/tutos';
            $filePath = $name. '.' . $img->getClientOriginalExtension();
            $img->storeAs($folder, $filePath, 'public');
        } else {
            $request['files']='';
        }
        if (!$request['summary']){
            $request['summary']='';
        }
        if (!$request['content']){
            $request['content']='';
        }
        if (!$request['files']){
            $filePath='';
        }
        $newEntry = Tuto::create([
            'title'=>$request['title'],
            'difficulty'=>$request['difficulty'],
            'langage'=>$request['langage'],
            'state'=>$request['state'],
            'author_id'=>$request['author_id'],

            'summary'=>$request['summary'],
            'content'=>$request['content'],
            'ratings'=>$request['ratings'],
            'nb_ratings'=>$request['nb_ratings'],
            'files'=>$filePath,
        ]);

        return response()->json('new_entry = '.$newEntry->id,201);
    }

    function index(){
        $tutos =  Tuto::where('state','=','2')->get();
        foreach ($tutos as $tuto){
            $tmp =  DB::table('users')->whereId($tuto->author_id)->first();
            if ($tmp !== null) {
                $tuto['authorName'] = $tmp->name;
            } else {
                $tuto['authorName'] = 'nobody';
            }
            $tmpImg =  DB::table('langages')->where('name',$tuto->langage)->first();
            $tuto['imgName'] = $tmpImg->imgName;

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
        $tutos =  Tuto::whereId($id)->first();
        $tmpImg =  DB::table('langages')->where('name',$tutos->langage)->first();
            $tutos['imgName'] = $tmpImg->imgName;
        return response()->json([
            'code' => 200,
            'result' => $tutos],200);
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
            'difficulty' => 'string',
            'langage' => 'string',
            'state' => 'string',
            'summary' => 'string|max:255',
            'content' => 'string',
            'files'=>  'mimes:pdf|max:1000'

        ]);
        if ($validator->fails()){
            return response()->json([
                'code'      =>  422,
                'message'   =>  'Error validator']
                ,422);
        }



        $tuto = Tuto::whereId($id)->first();
        $tuto->update([
            'title'=>$request['title'],
            'difficulty'=>$request['difficulty'],
            'langage'=>$request['langage'],
            'state'=>$request['state'],
            'summary'=>$request['summary'],
            'content'=>$request['content'],


        ]);

        if ($request->has('files')){
            $img=$request->file('files');
            $name = Str::slug('tuto_'.time());
            $folder = '/uploads/tutos';
            $filePath = $name. '.' . $img->getClientOriginalExtension();
            $img->storeAs($folder, $filePath, 'public');
            $tuto->files=$filePath;
            $tuto->save();
        }
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
        $tutos =  Tuto::where('title','like','%'.$request['searchField'].'%')
                    ->orWhere('langage','like','%'.$request['searchField'].'%')
                    ->get();

        if (count($tutos) ==0){
            return response()->json([
                "code" => 200,
                "messages"=> 'Result for '.$request['searchField'],
                "result" => 'No result for you']
            );
        }

        foreach ($tutos as $tuto){

            $tmpUser= DB::table('users')->whereId($tuto->author_id)->first();
            if ($tmpUser !== null) {
                $tuto['authorName'] = $tmpUser->name;
            } else {
                $tuto['authorName'] = 'nobody';
            }
        }
        return response()->json([
            "code" => 200,
            "messages"=> 'Result for '.$request['searchField'],
            "result" => $tutos]);
    }

    function download(Request $request){
        $tuto = Tuto::whereId($request['id'])->first();
        return  Storage::download("public/uploads/tutos/".$tuto->files);
    }

    function archive(Request $request){
        $tuto = Tuto::whereId($request['id'])->first();
        $tuto->state = 3;
        $tuto->save();
        return response()->json('Tuto archived');
    }
}
