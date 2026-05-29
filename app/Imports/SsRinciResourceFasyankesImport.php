<?php

namespace App\Imports;

use App\Models\SsRinciResourceFasyankes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SsRinciResourceFasyankesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            if (empty($row['kode_sarana'])) {
                continue;
            }

            SsRinciResourceFasyankes::updateOrCreate(
                [
                    'kode_sarana' => $row['kode_sarana'],
                ],
                [
                    'id_organisasi' => $row['id_organisasi'] ?? null,
                    'nama_fasyankes' => $row['nama_fasyankes'] ?? null,
                    'lokasi' => $row['lokasi'] ?? null,
                    'jenis_sarana' => $row['jenis_sarana'] ?? null,
                    'kunjungan_pasien' => $this->toBoolean($row['kunjungan_pasien_encounter'] ?? null),
                    'kondisi_diagnosis' => $this->toBoolean($row['kondisi_diagnosis_condition'] ?? null),
                    'observasi' => $this->toBoolean($row['observasi_observation'] ?? null),
                    'tindakan' => $this->toBoolean($row['tindakan_procedure'] ?? null),
                    'resume_diet' => $this->toBoolean($row['resume_diet_composition'] ?? null),
                    'resep_obat' => $this->toBoolean($row['resep_obat_medicationrequest'] ?? null),
                    'tebus_obat' => $this->toBoolean($row['tebus_obat_medicationdispense'] ?? null),
                    'permintaan_pemeriksaan' => $this->toBoolean($row['permintaan_pemeriksaan_servicerequest'] ?? null),
                    'spesimen' => $this->toBoolean($row['spesimen_specimen'] ?? null),
                    'laporan_pemeriksaan' => $this->toBoolean($row['laporan_pemeriksaan_diagnosticreport'] ?? null),
                    'alergi_intoleran' => $this->toBoolean($row['alergi_intoleran_allergyintolerance'] ?? null),
                    'impresi_klinis' => $this->toBoolean($row['impresi_klinis_clinicalimpression'] ?? null),
                    'rencana_perawatan' => $this->toBoolean($row['rencana_perawatan_careplan'] ?? null),
                    'respon_kuesioner' => $this->toBoolean($row['respon_kuesioner_questionnaireresponse'] ?? null),
                    'catatan_pengobatan' => $this->toBoolean($row['catatan_pengobatan_medicationstatement'] ?? null),
                    'jumlah_tahapan' => (int) ($row['jumlah_tahapan'] ?? 0),
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
