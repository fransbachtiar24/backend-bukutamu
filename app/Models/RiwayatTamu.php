<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tamu',
        'no_hp',
        'pegawai_id',
        'asal_instansi',
        'bidang',
        'jabatan',
        'keperluan',
        'detail_keperluan',
        'tujuan',
        'jumlah_tamu'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function getPegawaiNameAttribute()
    {
        return $this->pegawai->jenis_pegawai;
    }
}