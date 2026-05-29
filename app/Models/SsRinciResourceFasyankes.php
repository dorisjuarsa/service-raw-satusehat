<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsRinciResourceFasyankes extends Model
{
    protected $table = 'ss_rinci_resource_fasyankes';

    protected $fillable = [
        'id_organisasi',
        'nama_fasyankes',
        'lokasi',
        'kode_sarana',
        'jenis_sarana',
        'kunjungan_pasien',
        'kondisi_diagnosis',
        'observasi',
        'tindakan',
        'resume_diet',
        'resep_obat',
        'tebus_obat',
        'permintaan_pemeriksaan',
        'spesimen',
        'laporan_pemeriksaan',
        'alergi_intoleran',
        'impresi_klinis',
        'rencana_perawatan',
        'respon_kuesioner',
        'catatan_pengobatan',
        'jumlah_tahapan',
    ];

    protected function casts(): array
    {
        return [
            'kunjungan_pasien' => 'boolean',
            'kondisi_diagnosis' => 'boolean',
            'observasi' => 'boolean',
            'tindakan' => 'boolean',
            'resume_diet' => 'boolean',
            'resep_obat' => 'boolean',
            'tebus_obat' => 'boolean',
            'permintaan_pemeriksaan' => 'boolean',
            'spesimen' => 'boolean',
            'laporan_pemeriksaan' => 'boolean',
            'alergi_intoleran' => 'boolean',
            'impresi_klinis' => 'boolean',
            'rencana_perawatan' => 'boolean',
            'respon_kuesioner' => 'boolean',
            'catatan_pengobatan' => 'boolean',
            'jumlah_tahapan' => 'integer',
        ];
    }
}
