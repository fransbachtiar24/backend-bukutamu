<?php

namespace App\Http\Controllers;

use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $pegawai = Pegawai::get();
        if(is_null($pegawai)){
            $data = 'null';
            $message = "Data Tidak Di Temukan !";
        }else {
            $data = PegawaiResource::collection($pegawai);
            $message = "Data Di Temukan !";
        }

        if($data){
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Data Tidak Di Temukan !'
                ]
            ], 500);
        }
    }

    public function byId($id)
    {
              $pegawai = Pegawai::find($id);
        if(is_null($pegawai)){
            $data = 'null';
            $message = "Data Tidak Di Temukan !";
        }else {
            $data = new PegawaiResource($pegawai);
            $message = "Data Di Temukan !";
        }

        if($data){
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Data Tidak Di Temukan !'
                ]
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
         if(empty($request->jenis_pegawai)) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => "Jenis Pegawai Tidak Boleh Kosong"
                ]
            ], 400);
        }
        ;

        $dinas = Pegawai::create([
            'jenis_pegawai' => $request->jenis_pegawai,
        ]);

        if($dinas){
            return response()->json([
                'success' => true,
                'message' => "Data Jenis Pegawai Berhasil Dit Tambahkan !",
            ]);
        }else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => "Data Tidak Berhasil Di Tambahkan"
                ]
            ]);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
           if(empty($request->jenis_pegawai)){
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Jenis Pegawai Tidak Boleh Kosong'
                ]
            ], 400);
        }

        $dinas = Pegawai::find($id);
        $dinas -> update([
            'jenis_pegawai' => $request->jenis_pegawai, 
        ]);

        
        if($dinas) {
            return response()->json([
                'success' => true,
                'data' => [
                     'message' => 'Data Jenis Pegawai Berhasil Di Update',
                ]
            ], 200);
        }else {
            return response()->json([
                'success' => false,
               'data' => [
                 'message' => 'Data Tidak Ditemukan !'
               ]
            ], 404);
        };
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dinas = Pegawai::find($id);
        $dinas->delete();

        if($dinas){
            return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'Data Jenis Pegawai Berhasil Di Hapus !'
                ]
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Data Tidak Berhasil Di Hapus!'
                ]
            ], 400);
        }
        ;
    }
}