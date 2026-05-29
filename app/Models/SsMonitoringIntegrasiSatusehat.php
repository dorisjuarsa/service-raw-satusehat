<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsMonitoringIntegrasiSatusehat extends Model
{
    protected $table = 'ss_monitoring_integrasi_satusehat';

    protected $fillable = [
        'ihs_code',
        'kode_sarana',
        'nama_fasyankes',
        'provinsi',
        'kabkota',
        'pengiriman_kunjungan_terakhir',
        'nama_sistem_rme',
        'persen_penggunaan_resources',
        'jumlah_kunjungan',
        'jumlah_diagnosis',
        'jumlah_observasi',
        'jumlah_tindakan',
        'jumlah_diet',
        'jumlah_peresepan_obat',
        'jumlah_obat_dibawa_pulang',
        'jumlah_layanan_penunjang',
        'jumlah_laboratorium',
        'jumlah_pelaporan_diagnostik',
        'jumlah_intoleransi_alergi',
        'jumlah_impresi_kliniki',
        'jumlah_radiologi',
        'jumlah_imunisasi',
    ];

    protected function casts(): array
    {
        return [
            'pengiriman_kunjungan_terakhir' => 'date',
            'persen_penggunaan_resources' => 'float',
            'jumlah_kunjungan' => 'integer',
            'jumlah_diagnosis' => 'integer',
            'jumlah_observasi' => 'integer',
            'jumlah_tindakan' => 'integer',
            'jumlah_diet' => 'integer',
            'jumlah_peresepan_obat' => 'integer',
            'jumlah_obat_dibawa_pulang' => 'integer',
            'jumlah_layanan_penunjang' => 'integer',
            'jumlah_laboratorium' => 'integer',
            'jumlah_pelaporan_diagnostik' => 'integer',
            'jumlah_intoleransi_alergi' => 'integer',
            'jumlah_impresi_kliniki' => 'integer',
            'jumlah_radiologi' => 'integer',
            'jumlah_imunisasi' => 'integer',
        ];
    }
}
