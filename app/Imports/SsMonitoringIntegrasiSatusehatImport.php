<?php

namespace App\Imports;

use App\Models\SsMonitoringIntegrasiSatusehat;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SsMonitoringIntegrasiSatusehatImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            if (empty($row['kode_sarana'])) {
                continue;
            }

            SsMonitoringIntegrasiSatusehat::updateOrCreate(
                [
                    'kode_sarana' => (string) $row['kode_sarana'],
                ],
                [
                    'ihs_code' => $row['ihs_code'] ?? null,
                    'nama_fasyankes' => $row['nama_fasyankes'] ?? null,
                    'provinsi' => $row['provinsi'] ?? null,
                    'kabkota' => $row['kabkota'] ?? null,
                    'pengiriman_kunjungan_terakhir' => $this->toDate($row['pengiriman_kunjungan_terakhir'] ?? null),
                    'nama_sistem_rme' => $row['nama_sistem_rme'] ?? null,
                    'persen_penggunaan_resources' => $this->toPercentage($row['penggunaan_resources'] ?? null),
                    'jumlah_kunjungan' => $this->toInteger($row['jumlah_kunjungan_encounter'] ?? null),
                    'jumlah_diagnosis' => $this->toInteger($row['jumlah_diagnosis_condition'] ?? null),
                    'jumlah_observasi' => $this->toInteger($row['jumlah_observasi_observation'] ?? null),
                    'jumlah_tindakan' => $this->toInteger($row['jumlah_tindakan_procedure'] ?? null),
                    'jumlah_diet' => $this->toInteger($row['jumlah_diet_composition'] ?? null),
                    'jumlah_peresepan_obat' => $this->toInteger($row['jumlah_peresepan_obat_medication_request'] ?? null),
                    'jumlah_obat_dibawa_pulang' => $this->toInteger($row['jumlah_obat_dibawa_pulang_medication_dispense'] ?? null),
                    'jumlah_layanan_penunjang' => $this->toInteger($row['jumlah_layanan_penunjang_service_request'] ?? null),
                    'jumlah_laboratorium' => $this->toInteger($row['jumlah_laboratorium_specimen'] ?? null),
                    'jumlah_pelaporan_diagnostik' => $this->toInteger($row['jumlah_pelaporan_diagnostik_diagnostic_report'] ?? null),
                    'jumlah_intoleransi_alergi' => $this->toInteger($row['jumlah_intoleransi_alergi_allergy_intolerance'] ?? null),
                    'jumlah_impresi_kliniki' => $this->toInteger($row['jumlah_impresi_kliniki_clinical_impression'] ?? null),
                    'jumlah_radiologi' => $this->toInteger($row['jumlah_radiologi_imaging_study'] ?? null),
                    'jumlah_imunisasi' => $this->toInteger($row['jumlah_imunisasi_immunization'] ?? null),
                ]
            );
        }
    }

    private function toInteger(mixed $value): int
    {
        $normalized = preg_replace('/[^0-9\-]/', '', (string) $value);

        return $normalized === '' ? 0 : (int) $normalized;
    }

    private function toPercentage(mixed $value): float
    {
        $normalized = str_replace('%', '', trim((string) $value));

        return is_numeric($normalized) ? (float) $normalized : 0.0;
    }

    private function toDate(mixed $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse((string) $value)->toDateString();
        } catch (\Throwable) {
            return null;
        }
    }
}
