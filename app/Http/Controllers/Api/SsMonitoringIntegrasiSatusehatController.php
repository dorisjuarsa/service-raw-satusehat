<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\SsMonitoringIntegrasiSatusehatImport;
use App\Models\SsMonitoringIntegrasiSatusehat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class SsMonitoringIntegrasiSatusehatController extends Controller
{
    public function index(): JsonResponse
    {
        $data = SsMonitoringIntegrasiSatusehat::query()
            ->latest('updated_at')
            ->paginate(20);

        return response()->json($data);
    }

    public function show(string $kode_sarana): JsonResponse
    {
        $data = SsMonitoringIntegrasiSatusehat::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $payload = $this->validatePayload($request, true);

        $data = SsMonitoringIntegrasiSatusehat::query()->create($payload);

        return response()->json($data, 201);
    }

    public function update(Request $request, string $kode_sarana): JsonResponse
    {
        $data = SsMonitoringIntegrasiSatusehat::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        $payload = $this->validatePayload($request, false, $data->id);

        $data->fill($payload)->save();

        return response()->json($data);
    }

    public function destroy(string $kode_sarana): JsonResponse
    {
        $data = SsMonitoringIntegrasiSatusehat::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        $data->delete();

        return response()->json([
            'message' => 'Data deleted successfully.',
        ]);
    }

    public function import(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv,txt',
                'mimetypes:text/csv,text/plain,application/csv,application/vnd.ms-excel,application/octet-stream,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'max:10240',
            ],
        ]);

        try {
            Excel::import(new SsMonitoringIntegrasiSatusehatImport(), $validated['file']);

            return response()->json([
                'message' => 'Import completed successfully.',
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Import failed.',
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    private function validatePayload(Request $request, bool $isCreate, ?int $ignoreId = null): array
    {
        $kodeRules = ['required', 'string', 'max:255', 'unique:ss_monitoring_integrasi_satusehat,kode_sarana'];

        if (!$isCreate) {
            $kodeRules = ['sometimes', 'string', 'max:255', 'unique:ss_monitoring_integrasi_satusehat,kode_sarana,' . $ignoreId];
        }

        $requiredOrSometimes = $isCreate ? 'required' : 'sometimes';

        return $request->validate([
            'ihs_code' => [$requiredOrSometimes, 'string', 'max:255'],
            'kode_sarana' => $kodeRules,
            'nama_fasyankes' => [$requiredOrSometimes, 'string', 'max:255'],
            'provinsi' => [$requiredOrSometimes, 'string', 'max:255'],
            'kabkota' => [$requiredOrSometimes, 'string', 'max:255'],
            'pengiriman_kunjungan_terakhir' => [$requiredOrSometimes, 'date'],
            'nama_sistem_rme' => [$requiredOrSometimes, 'string', 'max:255'],
            'persen_penggunaan_resources' => [$requiredOrSometimes, 'numeric', 'min:0', 'max:100'],
            'jumlah_kunjungan' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_diagnosis' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_observasi' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_tindakan' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_diet' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_peresepan_obat' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_obat_dibawa_pulang' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_layanan_penunjang' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_laboratorium' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_pelaporan_diagnostik' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_intoleransi_alergi' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_impresi_kliniki' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_radiologi' => [$requiredOrSometimes, 'integer', 'min:0'],
            'jumlah_imunisasi' => [$requiredOrSometimes, 'integer', 'min:0'],
        ]);
    }
}
