<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     *  @param  \Illuminate\Http\Request  $request
     */
    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:png,jpg,jpeg,gif|max:2305',]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if($file = $request->file('file')){
            $path = $request->file('file')->store('public/files');
            $name = $file->getClientOriginalName();

            $save = new File();
            $save->user_id = User::query()->inRandomOrder()->first()->id;
            $save->name = $name;
            $save->path = $path;
            $save->type = 'image';
            $save->extension = 'png';
            $save->size = 404;
            $save->published_at = Carbon::now();
            $save->save();


            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file,
            ]);
        }
    }
}
