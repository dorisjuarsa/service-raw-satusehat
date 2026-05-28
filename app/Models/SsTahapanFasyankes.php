<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsTahapanFasyankes extends Model
{
    protected $fillable = [
        'lokasi',
        'id_organisasi',
        'nama_fasyankes',
        'kode_sarana',
        'jenis_sarana',
        'alamat_fasyankes',
        'terdaftar',
        'terkoneksi',
        'terintegrasi',
        'jumlah_tahapan',
    ];

    protected function casts(): array
    {
        return [
            'terdaftar' => 'boolean',
            'terkoneksi' => 'boolean',
            'terintegrasi' => 'boolean',
            'jumlah_tahapan' => 'integer',
        ];
    }
}
