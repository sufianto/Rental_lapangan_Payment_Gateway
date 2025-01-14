<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biaya;
use Illuminate\Support\Facades\DB;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biaya = Biaya::orderBy('kelas_lapangan', 'asc')->get();
        return view('backend.v_biaya.index', [
            'judul' => 'Biaya Lapangan',
            'index' => $biaya
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_biaya.create', [
            'judul' => 'Tambah Biaya',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'kelas_lapangan' => 'required|max:255|unique:biaya',
            'biaya_lapangan' => 'required|numeric',
            'stok_lapangan' => 'required|integer',
        ]);
        $validatedData['stok_awal'] = $validatedData['stok_lapangan'];

        Biaya::create($validatedData);
        return redirect()->route('backend.biaya.index')->with('success', 'Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $biaya = Biaya::find($id);
        return view('backend.v_biaya.edit', [
            'judul' => 'Ubah Biaya',
            'edit' => $biaya
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'kelas_lapangan' => 'required|max:255|unique:biaya,kelas_lapangan,' . $id,
            'biaya_lapangan' => 'required|numeric',
            'stok_lapangan' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);
        Biaya::where('id', $id)->update($validatedData);
        return redirect()->route('backend.biaya.index')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biaya = Biaya::findOrFail($id);
        $biaya->delete();
        return redirect()->route('backend.biaya.index')->with('success', 'Data berhasil dihapus');
    }

    public function resetStok()
{
    Biaya::query()->update(['stok_lapangan' => DB::raw('stok_awal')]);
    return redirect()->back()->with('success', 'Stok berhasil direset.');
}
}
