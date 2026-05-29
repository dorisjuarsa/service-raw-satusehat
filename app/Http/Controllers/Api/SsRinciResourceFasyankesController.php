<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\SsRinciResourceFasyankesImport;
use App\Models\SsRinciResourceFasyankes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class SsRinciResourceFasyankesController extends Controller
{
    public function index(): JsonResponse
    {
        $data = SsRinciResourceFasyankes::query()
            ->latest('updated_at')
            ->paginate(20);

        return response()->json($data);
    }

    public function show(string $kode_sarana): JsonResponse
    {
        $data = SsRinciResourceFasyankes::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $payload = $this->validatePayload($request, true);

        $data = SsRinciResourceFasyankes::query()->create($payload);

        return response()->json($data, 201);
    }

    public function update(Request $request, string $kode_sarana): JsonResponse
    {
        $data = SsRinciResourceFasyankes::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        $payload = $this->validatePayload($request, false, $data->id);

        $data->fill($payload)->save();

        return response()->json($data);
    }

    public function destroy(string $kode_sarana): JsonResponse
    {
        $data = SsRinciResourceFasyankes::query()
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
            Excel::import(new SsRinciResourceFasyankesImport(), $validated['file']);

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
        $kodeRules = ['required', 'string', 'max:255', 'unique:ss_rinci_resource_fasyankes,kode_sarana'];

        if (!$isCreate) {
            $kodeRules = ['sometimes', 'string', 'max:255', 'unique:ss_rinci_resource_fasyankes,kode_sarana,' . $ignoreId];
        }

        $requiredOrSometimes = $isCreate ? 'required' : 'sometimes';

        return $request->validate([
            'id_organisasi' => [$requiredOrSometimes, 'string', 'max:255'],
            'nama_fasyankes' => [$requiredOrSometimes, 'string', 'max:255'],
            'lokasi' => [$requiredOrSometimes, 'string', 'max:255'],
            'kode_sarana' => $kodeRules,
            'jenis_sarana' => [$requiredOrSometimes, 'string', 'max:255'],
            'kunjungan_pasien' => [$requiredOrSometimes, 'boolean'],
            'kondisi_diagnosis' => [$requiredOrSometimes, 'boolean'],
            'observasi' => [$requiredOrSometimes, 'boolean'],
            'tindakan' => [$requiredOrSometimes, 'boolean'],
            'resume_diet' => [$requiredOrSometimes, 'boolean'],
            'resep_obat' => [$requiredOrSometimes, 'boolean'],
            'tebus_obat' => [$requiredOrSometimes, 'boolean'],
            'permintaan_pemeriksaan' => [$requiredOrSometimes, 'boolean'],
            'spesimen' => [$requiredOrSometimes, 'boolean'],
            'laporan_pemeriksaan' => [$requiredOrSometimes, 'boolean'],
            'alergi_intoleran' => [$requiredOrSometimes, 'boolean'],
            'impresi_klinis' => [$requiredOrSometimes, 'boolean'],
            'rencana_perawatan' => [$requiredOrSometimes, 'boolean'],
            'respon_kuesioner' => [$requiredOrSometimes, 'boolean'],
            'catatan_pengobatan' => [$requiredOrSometimes, 'boolean'],
            'jumlah_tahapan' => [$requiredOrSometimes, 'integer', 'min:0', 'max:255'],
        ]);
    }
}
