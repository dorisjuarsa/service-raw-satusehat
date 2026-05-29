<?php

namespace App\Imports;

use App\Models\SsTahapanFasyankes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SsTahapanFasyankesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            if (empty($row['kode_sarana'])) {
                continue;
            }
            SsTahapanFasyankes::updateOrCreate(
                [
                    'kode_sarana' => $row['kode_sarana'],
                ],
                [
                    'lokasi' => $row['lokasi'],
                    'id_organisasi' => $row['id_organisasi'],
                    'nama_fasyankes' => $row['nama_fasyankes'],
                    'jenis_sarana' => $row['jenis_sarana'],
                    'alamat_fasyankes' => $row['alamat_fasyankes'],
                    'terdaftar' => $this->toBoolean($row['terdaftar_terdaftar_satusehat_portal_atau_status_memiliki_rme'] ?? null),
                    'terkoneksi' => $this->toBoolean($row['terkoneksi_telah_diberikan_api_production'] ?? null),
                    'terintegrasi' => $this->toBoolean($row['terintegrasi_mengirimkan_data_ke_satusehat'] ?? null),
                    'jumlah_tahapan' => (int) $row['jumlah_tahapan'],
                ]
            );
        }
    }

    private function toBoolean(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        $normalized = strtolower(trim((string) $value));
        return in_array($normalized, ['1', 'true', 'ya', 'yes', 'y'], true);
    }
}
