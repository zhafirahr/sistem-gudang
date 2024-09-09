<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Get all barangs
    public function index()
    {
        return response()->json(Barang::all());
    }

    // Store a new barang
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode' => 'required|unique:barangs',
            'kategori' => 'required',
            'lokasi' => 'required'
        ]);

        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->kode = $request->kode;
        $barang->kategori = $request->kategori;
        $barang->lokasi = $request->lokasi;
        $barang->save();

        return response()->json($barang, 201);
    }

    // Show a specific barang
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return response()->json($barang);
    }

    // Update a barang
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->update($request->all());
        return response()->json($barang);
    }

    // Delete a barang
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();
        return response()->json(['message' => 'Barang deleted successfully']);
    }
}