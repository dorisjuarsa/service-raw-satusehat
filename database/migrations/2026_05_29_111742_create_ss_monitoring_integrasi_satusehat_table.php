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
        Schema::create('ss_monitoring_integrasi_satusehat', function (Blueprint $table) {
            $table->id();
            $table->string('ihs_code')->nullable();
            $table->string('kode_sarana')->unique();
            $table->string('nama_fasyankes');
            $table->string('provinsi');
            $table->string('kabkota');
            $table->date('pengiriman_kunjungan_terakhir')->nullable();
            $table->string('nama_sistem_rme')->nullable();
            $table->decimal('persen_penggunaan_resources', 5, 2)->default(0);
            $table->unsignedBigInteger('jumlah_kunjungan')->default(0);
            $table->unsignedBigInteger('jumlah_diagnosis')->default(0);
            $table->unsignedBigInteger('jumlah_observasi')->default(0);
            $table->unsignedBigInteger('jumlah_tindakan')->default(0);
            $table->unsignedBigInteger('jumlah_diet')->default(0);
            $table->unsignedBigInteger('jumlah_peresepan_obat')->default(0);
            $table->unsignedBigInteger('jumlah_obat_dibawa_pulang')->default(0);
            $table->unsignedBigInteger('jumlah_layanan_penunjang')->default(0);
            $table->unsignedBigInteger('jumlah_laboratorium')->default(0);
            $table->unsignedBigInteger('jumlah_pelaporan_diagnostik')->default(0);
            $table->unsignedBigInteger('jumlah_intoleransi_alergi')->default(0);
            $table->unsignedBigInteger('jumlah_impresi_kliniki')->default(0);
            $table->unsignedBigInteger('jumlah_radiologi')->default(0);
            $table->unsignedBigInteger('jumlah_imunisasi')->default(0);
            $table->timestamps();

            $table->index('ihs_code');
            $table->index('provinsi');
            $table->index('kabkota');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ss_monitoring_integrasi_satusehat');
    }
};
