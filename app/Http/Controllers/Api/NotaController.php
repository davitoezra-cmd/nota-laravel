<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotaResource;
use App\Models\Nota;
use App\Models\DetailNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_nota' => 'required|unique:notas,no_nota',
            'tanggal' => 'required|date',
            'nama_penerima' => 'required|string',
            'total_jumlah' => 'required|integer',
            'kd_barang' => 'required|string',
            'quantity' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //menyimpan nota
        $nota = Nota::create([
            'no_nota' => $request->no_nota,
            'tanggal' => $request->tanggal,
            'nama_penerima' => $request->nama_penerima,
            'total_jumlah' => $request->total_jumlah,
            'kd_apotek' => $request->user()->kd_apotek,
            'id_user' => $request->user()->id,
        ]);

        //menyimpan detail nota
        DetailNota::create([
            'no_nota' => $request->no_nota,
            'kd_barang' => $request->kd_barang,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return new NotaResource($nota->load('detailNota'), true, 'Nota Created');
    }

    
    public function show($id)
    {
        $nota = Nota::with('detailNota')
                    ->where('no_nota', $id)
                    ->first();

        if (!$nota) {
            return response()->json(['message' => 'Nota not found'], 404);
        }

        return new NotaResource($nota, true, 'Detail Nota');
    }
}
