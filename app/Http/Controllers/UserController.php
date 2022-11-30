<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = User::all();

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
        $table = new User ();
       $table->name = $request->name;
       $table->email = $request->email;
       $table->password = $request->password;
       $table->birthdate = $request->birthdate;
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
        $table = User::find($id);
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
        $table = User::find($id);
        if($table){
            $table->name = $request->name ? $request->name : $table->name;
            $table->email = $request->email ? $request->email : $table->email;
            $table->password = $request->password ? $request->password : $table->password;
            $table->birthdate = $request->birthdate ? $request->birthdate : $table->birthdate;
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
        $table = User::find($id);
        if ($table){
            $table->delete();
            return ["message" => "Delete success"];
        }else{
            return ["message" => "Data not found"];
        }
    }

    public function pesan_kamar(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id_kamar' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData(); 

        $datakamar = Kamar::where('id',$validated['id_kamar'])->get()->first();
        $hitung_kembalian = $request->total_uang_diterima - $datakamar->harga_kamar;

        if ($hitung_kembalian < 0 ){
            $hasil_konfirmasi = 'Tidak Lunas';
        }else{
            $hasil_konfirmasi = 'Lunas';
        }
 
        $table = new Pembayaran ();
        $table->id_user = $request->id_user;
        $table->id_kamar = $request->id_kamar;
        $table->metode_pembayaran = $request->metode_pembayaran;
        $table->waktu_pembayaran = $request->waktu_pembayaran;
        $table->total_uang_diterima = $request->total_uang_diterima;
        $table->harga_total = $datakamar->harga_kamar;
        $table->kembalian = $hitung_kembalian;
        $table->konfirmasi_pembayaran = $hasil_konfirmasi;
        $table->save();

        Kamar::where('id',$request->id_kamar)->update(['status_booking'=>$request->status_booking]);
        
        //return $table;
        return response() ->json([
         "message" => "Pemesanan berhasil dilakukan",
         "data" => $table
        ], 201);
    }

    public function cek_kamar(Request $request)
    {
        $validator = validator::make($request->all(), [
            'status_booking' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData(); 

        $kamar = Kamar::where('status_booking', $validated['status_booking'])->get();
            
        if ($kamar) {
            return $kamar;
        }else{
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'Kamar penuh'
            ], 401);
        }
    }

    public function bukti_pembayaran(Request $request)
    {
        $validator = validator::make($request->all(), [
            'konfirmasi_pembayaran' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData(); 

        $pembayaran = Pembayaran::where('konfirmasi_pembayaran', $validated['konfirmasi_pembayaran'])->get();
            
        if ($pembayaran) {
            return $pembayaran;
        }else{
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'Pembayaran tidak ditemukan'
            ], 401);
        }
    }


    
    }

