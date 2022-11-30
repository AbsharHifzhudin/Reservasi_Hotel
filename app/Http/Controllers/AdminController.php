<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Admin::all();

        //return $data;
        return response() ->json([
            "message" => "Load data success",
            "data" => $table
        ], 200);
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
        $table = new Admin ();
        $table->nama_admin = $request->nama_admin;
        $table->email = $request->email;
        $table->password = $request->password;
        $table->gender = $request->gender;
        $table->save();
        
        //return $table;
        return response() ->json([
         "message" => "Store success",
         "data" => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Admin::find($id);
        if ($table){
            return $table;
        }else{
            return ["message" => "Data not found"];
        }
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
        $table = Admin::find($id);
        if($table){
            $table->nama_admin = $request->nama_admin ? $request->nama_admin : $table->nama_admin;
            $table->email = $request->email ? $request->email : $table->email;
            $table->password = $request->password ? $request->password : $table->password;
            $table->gender = $request->gender ? $request->gender : $table->gender;
            $table -> save();

            return $table;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Admin::find($id);
        if ($table){
            $table->delete();
            return ["message" => "Delete success"];
        }else{
            return ["message" => "Data not found"];
        }
    }
}
