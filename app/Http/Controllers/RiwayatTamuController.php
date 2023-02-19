<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTamu;
use Illuminate\Http\Request;

class RiwayatTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tamu = RiwayatTamu::with('pegawai')->get();
         if (!$tamu) {
             return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }
        return response()->json([
            'data' => $tamu->map(function ($tamu) {
                return [
                    'id' => $tamu->id,
                    'nama_tamu' => $tamu->nama_tamu,
                    'no_hp' => $tamu->no_hp,
                    'pegawai' => $tamu->pegawai->jenis_pegawai,
                    'asal_instansi' => $tamu->asal_instansi,
                    'bidang' => $tamu->bidang,
                    'jabatan' => $tamu->jabatan,
                    'keperluan' => $tamu->keperluan,
                    'detail_keperluan' => $tamu->detail_keperluan,
                    'tujuan' => $tamu->tujuan,
                    'jumlah_tamu' => $tamu->jumlah_tamu,
                    'image' => $tamu->image
                ];
            })
        ]);
    }

    public function byId($id)
    {
        $tamu = RiwayatTamu::with('pegawai')->find($id);

if (!$tamu) {
    return response()->json(['message' => 'Data tidak ditemukan.'], 404);
}

return response()->json([
    'data' => [
        'id' => $tamu->id,
        'nama_tamu' => $tamu->nama_tamu,
        'no_hp' => $tamu->no_hp,
        'pegawai' => $tamu->pegawai->jenis_pegawai,
        'asal_instansi' => $tamu->asal_instansi,
        'bidang' => $tamu->bidang,
        'jabatan' => $tamu->jabatan,
        'keperluan' => $tamu->keperluan,
        'detail_keperluan' => $tamu->detail_keperluan,
        'tujuan' => $tamu->tujuan,
        'jumlah_tamu' => $tamu->jumlah_tamu,
        'image' => $tamu->image
    ]
]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(empty($request->nama_tamu) && empty($request->no_hp) && empty($request->pegawai_id) && empty($request->asal_instansi) && empty($request->bidang) && empty($request->jabatan) && empty($request->keperluan) && empty($request->tujuan) && empty($request->jumlah_tamu) && empty($request->image)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Form Inputan Tidak Boleg Kosong'
                ]
            ], 400);
        }elseif(empty($request->nama_tamu)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Nama Tamu Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->no_hp)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Nomor Hp Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->pegawai_id)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Status Pegawai Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->asal_instansi)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Alamat/Asal Instansi Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->bidang)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Bidang Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->jabatan)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Jabatan Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->keperluan)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Keperluan Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->tujuan)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Tujuan Tidak Boleh Kosong !',
                ]
            ], 400);
        }elseif(empty($request->image)){
            return response()->json([
                'success' => 'false',
                'data' => [
                    'message' => 'Foto Tamu Tidak Boleh Kosong !',
                ]
            ], 400);
        }

  $tamu = RiwayatTamu::create([
    'nama_tamu' => $request->nama_tamu,
    'no_hp' => $request->no_hp,
    'pegawai_id' => $request->pegawai_id,
    'asal_instansi' => $request->asal_instansi,
    'bidang' => $request->bidang,
    'jabatan' => $request->jabatan,
    'keperluan' => $request->keperluan,
    'tujuan' => $request->tujuan,
    'detail_keperluan' => $request->detail_keperluan,
    'jumlah_tamu' => $request->jumlah_tamu,
]);

if ($request->hasFile('image')) {
    $filename = time() . '_' . $request->image->getClientOriginalName();
    $request->image->storeAs('public/images', $filename);
    $tamu->image = $filename;
    $tamu->save();
}

if ($tamu) {
    return response()->json([
        'success' => true,
        'data' => [
            'message' => 'Data Riwayat Tamu Berhasil Disimpan',
        ]
    ], 200);
} else {
    return response()->json([
        'success' => false,
        'data' => [
            'message' => 'Data Tidak Ditemukan !'
        ]
    ], 404);
};

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
     * @param  \App\Models\RiwayatTamu  $riwayatTamu
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatTamu $riwayatTamu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatTamu  $riwayatTamu
     * @return \Illuminate\Http\Response
     */
   public function edit(Request $request, $id)
    {
        $tamu = RiwayatTamu::find($id);
        
if (is_null($tamu)) {
    return response()->json([
        'success' => false,
        'data' => [
            'message' => 'Data tidak ditemukan'
        ]
    ], 404);
}


$tamu->nama_tamu = $request->nama_tamu;
$tamu->no_hp = $request->no_hp;
$tamu->pegawai_id = $request->pegawai_id;
$tamu->asal_instansi = $request->asal_instansi;
$tamu->bidang = $request->bidang;
$tamu->jabatan = $request->jabatan;
$tamu->keperluan = $request->keperluan;
$tamu->tujuan = $request->tujuan;
$tamu->detail_keperluan = $request->detail_keperluan;
$tamu->jumlah_tamu = $request->jumlah_tamu;

if ($request->hasFile('image')) {
    $filename = time() . '_' . $request->image->getClientOriginalName();
    $request->image->storeAs('public/images', $filename);
    $tamu->image = $filename;
}

$tamu->save();

return response()->json([
    'success' => true,
    'data' => [
        'message' => 'Data Riwayat Tamu Berhasil Di Update',
    ]
], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatTamu  $riwayatTamu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatTamu $riwayatTamu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatTamu  $riwayatTamu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $dinas = RiwayatTamu::find($id);
        $dinas->delete();

        if($dinas){
            return response()->json([
                'success' => true,
                'data' => [
                    'message' => 'Data Riwayat Tamu Berhasil Di Hapus !'
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