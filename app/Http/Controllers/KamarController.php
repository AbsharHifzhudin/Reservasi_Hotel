<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Kamar::all();

        //return $data;
        return response() ->json([
            "message" => "Load kamar success",
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
        $table = new Kamar ();
       $table->nomor_kamar = $request->nomor_kamar;
       $table->nama_kamar = $request->nama_kamar;
       $table->kapasitas = $request->kapasitas;
       $table->harga_kamar = $request->harga_kamar;
       $table->jenis_kamar = $request->jenis_kamar;
       $table->status_booking = $request->status_booking;
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
        $table = Kamar::find($id);
        if ($table){
            return $table;
        }else{
            return ["message" => "kamar not found"];
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
        $table = Kamar::find($id);
        if($table){
            $table->nomor_kamar = $request->nomor_kamar ? $request->nomor_kamar : $table->nomor_kamar;
            $table->nama_kamar = $request->nama_kamar ? $request->nama_kamar : $table->nama_kamar;
            $table->kapasitas = $request->kapasitas ? $request->kapasitas : $table->kapasitas;
            $table->harga_kamar = $request->harga_kamar ? $request->harga_kamar : $table->harga_kamar;
            $table->jenis_kamar = $request->jenis_kamar ? $request->jenis_kamar : $table->jenis_kamar;
            $table->status_booking = $request->status_booking ? $request->status_booking : $table->status_booking;
            $table -> save();

            return $table;
        }else{
            return ["message" => "Kamar not found"];
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
        $table = Kamar::find($id);
        if ($table){
            $table->delete();
            return ["message" => "Delete success"];
        }else{
            return ["message" => "Kamar not found"];
        }
    }
}
