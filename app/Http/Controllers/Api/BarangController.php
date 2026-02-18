<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotaResource;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate();

        return new NotaResource($barangs,true,'List Data Barang');

    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_barang' => 'required|string|unique:barang,kd_barang',
            'nama_barang' => 'required|string',
            'quantity' => 'required|integer',
            'satuan' => 'required|string',
            'harga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'kd_barang' => $request->kd_barang,
            'nama_barang' => $request->nama_barang,
            'quantity' => $request->quantity,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);
         return new NotaResource($barang,true,'Data Barang Created');
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return new NotaResource($barang,true,'Detail Data Barang');
    }
    
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kd_barang' => 'nullable|string|unique:barang,kd_barang,' . $id,
            'nama_barang' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'satuan' => 'nullable|string',
            'harga' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang->update([
            'kd_barang' => $request->kd_barang ?? $barang->kd_barang,
            'nama_barang' => $request->nama_barang ?? $barang->nama_barang,
            'quantity' => $request->quantity ?? $barang->quantity,
            'satuan' => $request->satuan ?? $barang->satuan,
            'harga' => $request->harga ?? $barang->harga,
        ]);

        return new NotaResource($barang,true,'Data Barang Updated');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
        return response()->json(['message' => 'Barang not found'], 404);
    }

         $barang->delete();

        return new NotaResource(null, true, 'Data Barang Deleted');
    }
}
