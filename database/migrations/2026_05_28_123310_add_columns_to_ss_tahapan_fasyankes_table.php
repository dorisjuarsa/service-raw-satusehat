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
        Schema::table('ss_tahapan_fasyankes', function (Blueprint $table) {
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('id');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'id_organisasi')) {
                $table->string('id_organisasi')->nullable()->after('lokasi');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'nama_fasyankes')) {
                $table->string('nama_fasyankes')->nullable()->after('id_organisasi');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'kode_sarana')) {
                $table->string('kode_sarana')->unique()->after('nama_fasyankes');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'jenis_sarana')) {
                $table->string('jenis_sarana')->nullable()->after('kode_sarana');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'alamat_fasyankes')) {
                $table->text('alamat_fasyankes')->nullable()->after('jenis_sarana');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'terdaftar')) {
                $table->boolean('terdaftar')->default(false)->after('alamat_fasyankes');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'terkoneksi')) {
                $table->boolean('terkoneksi')->default(false)->after('terdaftar');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'terintegrasi')) {
                $table->boolean('terintegrasi')->default(false)->after('terkoneksi');
            }
            if (!Schema::hasColumn('ss_tahapan_fasyankes', 'jumlah_tahapan')) {
                $table->unsignedTinyInteger('jumlah_tahapan')->default(0)->after('terintegrasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ss_tahapan_fasyankes', function (Blueprint $table) {
            $columns = [
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

            foreach ($columns as $column) {
                if (Schema::hasColumn('ss_tahapan_fasyankes', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
