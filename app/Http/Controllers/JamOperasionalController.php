<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Biaya;
use App\Models\FotoLapangan;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalLapangan;
use App\Models\penyewa;
use App\Models\StokLapangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JamOperasionalController extends Controller
{
    public function index(Request $request)
{
     $query = StokLapangan::query();

    // Filter berdasarkan kelas lapangan
    if ($request->has('kelas_lapangan') && $request->kelas_lapangan) {
        $query->whereHas('biaya', function ($q) use ($request) {
            $q->where('kelas_lapangan', $request->kelas_lapangan);
        });
    }

    // Filter berdasarkan tanggal sewa
    if ($request->has('tanggal_sewa') && $request->tanggal_sewa) {
        $query->where('tanggal_sewa', $request->tanggal_sewa);
    }

    // Filter berdasarkan mulai sewa
    if ($request->has('mulai_sewa') && $request->mulai_sewa) {
        $query->whereTime('mulai_sewa', '>=', $request->mulai_sewa);
    }

    // Filter berdasarkan akhir sewa
    if ($request->has('akhir_sewa') && $request->akhir_sewa) {
        $query->whereTime('akhir_sewa', '<=', $request->akhir_sewa);
    }

    // Ambil hasil pencarian
    $stokLapangan = $query->get();

    // Ambil daftar kelas lapangan untuk dropdown
    $kelasLapangans = Biaya::distinct()->pluck('kelas_lapangan');

    // Mengirim data ke view
    return view('backend.v_oprasional.index', compact('stokLapangan', 'kelasLapangans'));
}
    
    
public function store(Request $request)
{
    $request->validate([
        'biaya_id' => 'required|exists:biaya,id',
        'tanggal_sewa' => 'required|date',
        'mulai_sewa' => 'required|date_format:H:i',
        'akhir_sewa' => 'required|date_format:H:i|after:mulai_sewa',
        'stok_tersedia' => 'required|integer|min:0',
    ]);

    StokLapangan::create([
        'biaya_id' => $request->biaya_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'mulai_sewa' => Carbon::createFromFormat('H:i', $request->mulai_sewa),
        'akhir_sewa' => Carbon::createFromFormat('H:i', $request->akhir_sewa),
        'stok_tersedia' => $request->stok_tersedia,
    ]);

    return redirect()->route('backend.v_oprasional.index')->with('success', 'Jam operasional berhasil ditambahkan.');
}
public function edit($id)
{
    $stokLapangan = StokLapangan::findOrFail($id);
    $biaya = Biaya::all(); // Untuk dropdown pilihan biaya

    return view('backend.v_oprasional.edit', compact('stokLapangan', 'biaya'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'biaya_id' => 'required|exists:biaya,id',
        'tanggal_sewa' => 'required|date',
        'mulai_sewa' => 'required|date_format:H:i',
        'akhir_sewa' => 'required|date_format:H:i|after:mulai_sewa',
        'stok_tersedia' => 'required|integer|min:0',
    ]);

    $stokLapangan = StokLapangan::findOrFail($id);
    $stokLapangan->update([
        'biaya_id' => $request->biaya_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'mulai_sewa' => Carbon::createFromFormat('H:i', $request->mulai_sewa),
        'akhir_sewa' => Carbon::createFromFormat('H:i', $request->akhir_sewa),
        'stok_tersedia' => $request->stok_tersedia,
    ]);

    return redirect()->route('backend.v_oprasional.index')->with('success', 'Jam operasional berhasil diperbarui.');
}
public function destroy($id)
{
    $stokLapangan = StokLapangan::findOrFail($id);
    $stokLapangan->delete();

    return redirect()->route('backend.v_oprasional.index')->with('success', 'Jam operasional berhasil dihapus.');
}
public function create()
{
    $biaya = Biaya::all(); // Mengambil semua data biaya untuk dropdown
    return view('backend.v_oprasional.create', compact('biaya'));
}


}
