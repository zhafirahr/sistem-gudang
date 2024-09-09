<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    // Get all mutasis
    public function index()
    {
        return response()->json(Mutasi::all());
    }

    // Store a new mutasi
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required',
            'jumlah' => 'required|integer'
        ]);

        $mutasi = new Mutasi();
        $mutasi->user_id = $request->user_id;
        $mutasi->barang_id = $request->barang_id;
        $mutasi->tanggal = $request->tanggal;
        $mutasi->jenis_mutasi = $request->jenis_mutasi;
        $mutasi->jumlah = $request->jumlah;
        $mutasi->save();

        return response()->json($mutasi, 201);
    }

    // Show a specific mutasi
    public function show($id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        return response()->json($mutasi);
    }

    // Update a mutasi
    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        $mutasi->update($request->all());
        return response()->json($mutasi);
    }

    // Delete a mutasi
    public function destroy($id)
    {
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }

        $mutasi->delete();
        return response()->json(['message' => 'Mutasi deleted successfully']);
    }

    // Get mutasi by barang
    public function getByBarang($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $mutasi = Mutasi::where('barang_id', $id)->get();
        return response()->json($mutasi);
    }

    // Get mutasi by user
    public function getByUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $mutasi = Mutasi::where('user_id', $id)->get();
        return response()->json($mutasi);
    }
}
