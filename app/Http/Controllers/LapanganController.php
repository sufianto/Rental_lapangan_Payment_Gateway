<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Biaya;
use App\Models\FotoLapangan;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalLapangan;
use App\Models\penyewa;
use Carbon\Carbon;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = DB::table('lapangan')
        ->join('biaya', 'lapangan.kelas_lapangan', '=', 'biaya.kelas_lapangan')
        ->select(
            'lapangan.id',
            'lapangan.nama_lapangan',
            'lapangan.status',
            'lapangan.detail',
            'biaya.biaya_lapangan',
            'biaya.stok_lapangan',
            'biaya.stok_awal',
            'biaya.kelas_lapangan'
        )
        ->get();
        return view('backend.v_lapangan.index', [
            'judul' => 'Data Lapangan',
            'index' => $lapangan
        ]);
    }

    public function create()
    {
        $biaya = Biaya::orderBy('kelas_lapangan', 'asc')->get();
        return view('backend.v_lapangan.create', [
            'judul' => 'Tambah Lapangan',
            'biaya' => $biaya
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
             'kelas_lapangan' => 'required|exists:biaya,kelas_lapangan',
            'nama_lapangan' => 'required|max:255|unique:lapangan',
            'detail' => 'required',
            // 'biaya_lapangan' => 'required',
            // 'stok_lapangan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);
        $biaya = Biaya::where('kelas_lapangan', $request->kelas_lapangan)->first();
        $validatedData['biaya_lapangan'] = $biaya->biaya_lapangan;
        $validatedData['stok_lapangan'] = $biaya->stok_lapangan;
        $validatedData['user_id'] = auth()->id();
        $validatedData['status'] = 0;

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-lapangan/';
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validatedData['foto'] = $fileName;
        }

        Lapangan::create($validatedData);
        return redirect()->route('backend.lapangan.index')->with('success', 'Data berhasil tersimpan');
    }

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $biaya = Biaya::orderBy('kelas_lapangan', 'asc')->get();
        $edit = DB::table('lapangan')
        ->join('biaya', 'lapangan.kelas_lapangan', '=', 'biaya.kelas_lapangan')
        ->select(
            'lapangan.*', 
            'biaya.biaya_lapangan', 
            'biaya.stok_lapangan'
        )
        ->where('lapangan.id', $id)
        ->first();

    if (!$edit) {
        return redirect()->route('backend.lapangan.index')->with('error', 'Data tidak ditemukan.');
    }
        return view('backend.v_lapangan.edit', [
            'judul' => 'Ubah Lapangan',
            'edit' => $lapangan,
            'biaya' => $biaya
        ]);
    }

    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_lapangan' => 'required|max:255|unique:lapangan,nama_lapangan,' . $id,
             'kelas_lapangan' => 'required|exists:biaya,kelas_lapangan',
            'status' => 'required',
            'detail' => 'required',
            // 'biaya_lapangan' => 'required',
            // 'stok_lapangan' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);
        $biaya = Biaya::where('kelas_lapangan', $request->kelas_lapangan)->first();
        $validatedData['biaya_lapangan'] = $biaya->biaya_lapangan;
        $validatedData['stok_lapangan'] = $biaya->stok_lapangan;

        if ($request->file('foto')) {
            if ($lapangan->foto) {
                $oldImagePath = public_path('storage/img-lapangan/') . $lapangan->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-lapangan/';
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validatedData['foto'] = $fileName;
        }

        $lapangan->update($validatedData);
        return redirect()->route('backend.lapangan.index')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $directory = public_path('storage/img-lapangan/');
        if ($lapangan->foto) {
            $oldImagePath = $directory . $lapangan->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        FotoLapangan::where('lapangan_id', $id)->delete();
        $lapangan->delete();
        return redirect()->route('backend.lapangan.index')->with('success', 'Data berhasil dihapus');
    }

//     public function jadwal(Request $request, $lapangan_id)
// {
//     $jadwal = JadwalLapangan::where('lapangan_id', $lapangan_id)
//         ->whereDate('tanggal', '>=', now())
//         ->orderBy('tanggal', 'asc')
//         ->get();
//     return view('backend.v_penyewa.jadwal', compact('jadwal'));
// }
// public function tambahJadwal(Request $request, $lapangan_id)
// {
//     $request->validate([
//         'tanggal' => 'required|date|after_or_equal:today',
//         'jam_mulai' => 'required|date_format:H:i',
//         'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
//     ]);

//     // Pastikan tidak ada jadwal yang bertabrakan
//     $jadwalBertabrakan = JadwalLapangan::where('lapangan_id', $lapangan_id)
//         ->where('tanggal', $request->tanggal)
//         ->where(function ($query) use ($request) {
//             $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
//                   ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
//                   ->orWhere(function ($subquery) use ($request) {
//                       $subquery->where('jam_mulai', '<=', $request->jam_mulai)
//                                ->where('jam_selesai', '>=', $request->jam_selesai);
//                   });
//         })
//         ->exists();

//     if ($jadwalBertabrakan) {
//         return redirect()->back()->withErrors('Jadwal ini bertabrakan dengan jadwal lain.');
//     }

//     JadwalLapangan::create([
//         'lapangan_id' => $lapangan_id,
//         'tanggal' => $request->tanggal,
//         'jam_mulai' => $request->jam_mulai,
//         'jam_selesai' => $request->jam_selesai,
//         'penyewa_id' => $request->penyewa_id, // Optional, jika ingin melacak penyewa
//     ]);

//     return redirect()->route('backend.penyewa.jadwal', $lapangan_id)
//         ->with('success', 'Jadwal berhasil ditambahkan.');
// }

public function formLapangan()
{
    return view('backend.v_lapangan.form', [
        'judul' => 'Laporan Data Lapangan',
    ]);
}

public function cetakLapangan(Request $request)
{
    // Menambahkan aturan validasi
    $request->validate([
        'tanggal_awal' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
    ], [
        'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
        'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
        'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
    ]);
  

    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = Carbon::parse($request->input('tanggal_akhir'))->endOfDay();

    // Mengambil data lapangan berdasarkan range tanggal
    // $lapangan = Lapangan::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
    //     ->with('biaya')
    //     ->orderBy('id', 'desc')
    //     ->get();

        $lapangan = DB::table('lapangan')
        ->join('biaya', 'lapangan.kelas_lapangan', '=', 'biaya.kelas_lapangan')
        ->select(
            'lapangan.id',
            'lapangan.nama_lapangan',
            'lapangan.status',
            'lapangan.detail',
            'biaya.biaya_lapangan',
            'biaya.stok_lapangan',
            'biaya.kelas_lapangan'
        )
        ->get();

    return view('backend.v_lapangan.cetak', [
        'judul' => 'Laporan Data Lapangan',
        'tanggalAwal' => $tanggalAwal,
        'tanggalAkhir' => $tanggalAkhir,
        'cetak' => $lapangan,
    ]);
}
public function show(string $id)
{   
    $lapangan = Lapangan::with('fotoLapangan')->findOrFail($id);

    // $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
    // $lapangan = DB::table('lapangan')
    // ->join('biaya', 'lapangan.kelas_lapangan', '=', 'biaya.kelas_lapangan')
    // ->select(
    //     'lapangan.id',
    //     'lapangan.nama_lapangan',
    //     'lapangan.status',
    //     'lapangan.detail',
    //     'biaya.biaya_lapangan',
    //     'biaya.stok_lapangan',
    //     'biaya.kelas_lapangan'
    // )
   
    // ->get();
    $biaya = Biaya::orderBy('kelas_lapangan', 'asc')->get();
    return view('backend.v_lapangan.show', [
        'judul' => 'Detail Lapangan',
        'show' => $lapangan,
        'biaya' => $biaya
    ]);
}


}
