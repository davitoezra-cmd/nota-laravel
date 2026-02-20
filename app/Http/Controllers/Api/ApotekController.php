<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotaResource;
use App\Models\Apotek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ApotekController extends Controller
{
    public function index()
    {
        $apoteks = Apotek::latest()->paginate();

    return new NotaResource($apoteks,true,'List Data Apotek');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_apotek' => 'required|string|unique:apoteks,kd_apotek',
            'nama_apotek' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $apotek = Apotek::create([
            'kd_apotek' => $request->kd_apotek,
            'nama_apotek' => $request->nama_apotek,
        ]);
         return new NotaResource($apotek,true,'Data Apotek Created');
    }

    public function show($id)
    {
        $apotek = Apotek::find($id);

        if (!$apotek) {
            return response()->json(['message' => 'Apotek not found'], 404);
        }

        return new NotaResource($apotek,true,'Detail Data Apotek');
    }

    public function update(Request $request, $id)
    {
      $apotek = Apotek::find($id);

    if (!$apotek) {
        return response()->json(['message' => 'Apotek not found'], 404);
    }

    // 2️⃣ Validasi (perhatikan unique ignore id)
    $validator = Validator::make($request->all(), [
        'kd_apotek' => 'nullable|string|unique:apoteks,kd_apotek,' . $id,
        'nama_apotek' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // 3️⃣ Update data
    $apotek->update([
        'kd_apotek' => $request->kd_apotek,
        'nama_apotek' => $request->nama_apotek,
    ]);

    return new NotaResource($apotek, true, 'Data Apotek Updated');
}

    public function destroy($id)
    {
        $apotek = Apotek::find($id);

        if (!$apotek) {
        return response()->json(['message' => 'Apotek not found'], 404);
    }

         $apotek->delete();

        return new NotaResource(null, true, 'Data Apotek Deleted');
    }
}
