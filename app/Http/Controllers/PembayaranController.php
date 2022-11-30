<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Pembayaran::all();

        //return $data;
        return response() ->json([
            "message" => "Load pembayaran success",
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
        $table = new Pembayaran ();
        $table->id_user = $request->id_user;
        $table->id_kamar = $request->id_kamar;
        $table->metode_pembayaran = $request->metode_pembayaran;
        $table->waktu_pembayaran = $request->waktu_pembayaran;
        $table->total_uang_diterima = $request->total_uang_diterima;
        $table->harga_total= $request->harga_total;
        $table->kembalian = $request->kembalian;
        $table->konfirmasi_pembayaran = $request->konfirmasi_pembayaran;
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
        $table = Pembayaran::find($id);
        if ($table){
            return $table;
        }else{
            return ["message" => "pembayaran not found"];
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
        $table = Pembayaran::find($id);
        if($table){
            $table->id_user = $request->id_user ? $request->id_user : $table->id_user;
            $table->id_kamar = $request->id_kamar ? $request->id_kamar : $table->id_kamar;
            $table->metode_pembayaran = $request->metode_pembayaran ? $request->metode_pembayaran : $table->metode_pembayaran;
            $table->waktu_pembayaran = $request->waktu_pembayaran ? $request->waktu_pembayaran : $table->waktu_pembayaran;
            $table->total_uang_diterima = $request->total_uang_diterima  ? $request->total_uang_diterima  : $table->total_uang_diterima ;
            $table->harga_total = $request->harga_total ? $request->harga_total : $table->harga_total;
            $table->kembalian = $request->kembalian  ? $request->kembalian  : $table->kembalian ;
            $table->konfirmasi_pembayaran  = $request->konfirmasi_pembayaran   ? $request->konfirmasi_pembayaran  : $table->konfirmasi_pembayaran ;
            $table -> save();

            return $table;
        }else{
            return ["message" => "Pembayaran not found"];
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
        $table = Pembayaran::find($id);
        if ($table){
            $table->delete();
            return ["message" => "Delete success"];
        }else{
            return ["message" => "Pembayaran not found"];
        }
    }
}
