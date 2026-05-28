<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SsTahapanFasyankes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SsTahapanFasyankesController extends Controller
{
    public function index(): JsonResponse
    {
        $data = SsTahapanFasyankes::query()
            ->latest()
            ->paginate(20);

        return response()->json($data);
    }

    public function show(string $kode_sarana): JsonResponse
    {
        $data = SsTahapanFasyankes::query()
            ->where('kode_sarana', $kode_sarana)
            ->firstOrFail();

        return response()->json($data);
    }
}
