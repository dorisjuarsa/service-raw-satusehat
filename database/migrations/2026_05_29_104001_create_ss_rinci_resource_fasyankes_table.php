<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ss_rinci_resource_fasyankes', function (Blueprint $table) {
            $table->id();
            $table->string('id_organisasi');
            $table->string('nama_fasyankes');
            $table->string('lokasi');
            $table->string('kode_sarana')->unique();
            $table->string('jenis_sarana');
            $table->boolean('kunjungan_pasien')->default(false);
            $table->boolean('kondisi_diagnosis')->default(false);
            $table->boolean('observasi')->default(false);
            $table->boolean('tindakan')->default(false);
            $table->boolean('resume_diet')->default(false);
            $table->boolean('resep_obat')->default(false);
            $table->boolean('tebus_obat')->default(false);
            $table->boolean('permintaan_pemeriksaan')->default(false);
            $table->boolean('spesimen')->default(false);
            $table->boolean('laporan_pemeriksaan')->default(false);
            $table->boolean('alergi_intoleran')->default(false);
            $table->boolean('impresi_klinis')->default(false);
            $table->boolean('rencana_perawatan')->default(false);
            $table->boolean('respon_kuesioner')->default(false);
            $table->boolean('catatan_pengobatan')->default(false);
            $table->unsignedTinyInteger('jumlah_tahapan')->default(0);
            $table->timestamps();

            $table->index('id_organisasi');
            $table->index('lokasi');
            $table->index('jenis_sarana');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ss_rinci_resource_fasyankes');
    }
};
