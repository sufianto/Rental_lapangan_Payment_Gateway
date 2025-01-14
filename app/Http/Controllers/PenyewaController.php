<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Lapangan;
use App\Models\Biaya;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\StokLapangan;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Midtrans;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Str;


class PenyewaController extends Controller
{
    /**
     * Tampilkan daftar penyewa.
     */
    // public function index()
    // {
    //     $penyewa = Penyewa::with('lapangan')->get(); // Load relasi dengan lapangan
    //     $lapangan = Lapangan::all(); // 
    //     return view('backend.v_penyewa.index', compact('penyewa'));
    // }
    public function index()
    {
        if (Auth::user()->role == '2') {
            // Jika role adalah '2', hanya menampilkan penyewa yang dia input
            $penyewa = Penyewa::where('user_id', Auth::id())->get();
        
            return view('backend.v_penyewa.index', compact('penyewa'));
           
        } else {
            // Jika role bukan '2', menampilkan semua penyewa
            $penyewa = Penyewa::all();
        }
    
        return view('backend.v_penyewa.index', compact('penyewa'));
       
    }
//     public function index()
// {
//     $index = Lapangan::all(); // Ambil semua data lapangan
//     $judul = 'Daftar Lapangan'; // Judul halaman

//     return view('backend.v_lapangan.index', compact('index', 'judul'));
// }
    /**
     * Tampilkan form untuk menambahkan penyewa baru.
     */
    public function create()
    {
        $lapangans = Lapangan::with('biaya')->get();
        return view('backend.v_penyewa.create', compact('lapangans'));
    }
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_ENV') === 'production';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    public function charge(Request $request)
{
    $penyewa = Penyewa::where('order_id', $request->order_id)->firstOrFail();

    // Ambil penyewa berdasarkan ID
    // $penyewa = Penyewa::findOrFail($request->input('$penyewa->order_id'));
    // $penyewa = Penyewa::where('order_id')->get();
    // $penyewa = Penyewa::all();
    // $penyewa = Penyewa::first(); 
    // Detail transaksi
    $transaction_details = [
        'order_id' =>  $penyewa->order_id, // Order ID unik
        'gross_amount' => $penyewa->total_biaya, // Total biaya dari database
    ];

    // Detail item
    $item_details = [
        [
            'id' => 'item1',
            'price' => $penyewa->total_biaya,
            'quantity' => 1,
            'name' => 'Payment for ' . $penyewa->nama_penyewa,
        ],
    ];

    // Detail pelanggan
    $customer_details = [
        'first_name' => $penyewa->nama_penyewa,
        'email' => $penyewa->email ?? 'email@example.com', // Pastikan kolom email ada atau gunakan default
    ];

    // Data transaksi lengkap
    $transaction_data = [
        'transaction_details' => $transaction_details,
        'item_details' => $item_details,
        'customer_details' => $customer_details,
    ];

    // Dapatkan snap token dari Midtrans
    try {
        $snapToken = Snap::getSnapToken($transaction_data);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }

    // Tampilkan halaman pembayaran
    return view('backend.v_penyewa.payment_page', compact('snapToken', 'penyewa'));
}

public function updateStatus(Request $request)
{
    $request->validate([
        'order_id' => 'required|string',
        'status' => 'required|in:success,pending,failed',
    ]);

    // Pastikan Anda mendapatkan penyewa berdasarkan order_id
    $penyewa = Penyewa::where('order_id', $request->order_id)->first();

    if (!$penyewa) {
        return response()->json(['success' => false, 'message' => 'Order tidak ditemukan.']);
    }

    // Update status berdasarkan status yang diterima
    if ($request->status === 'success') {
        $penyewa->status_bayar = 1; // Pembayaran berhasil
    } elseif ($request->status === 'pending') {
        $penyewa->status_bayar = 0; // Pembayaran tertunda
    } else {
        $penyewa->status_bayar = 2; // Pembayaran gagal
    }

    $penyewa->save();

    return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui.']);
}

    
    /**
     * Simpan data penyewa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'lapangan_id' => 'required|exists:lapangan,id',
            'stok_lapangan' => 'required|integer|min:1',
            'mulai_sewa' => 'required|date',
            'akhir_sewa' => 'required|date|after:mulai_sewa',
            // 'status_bayar' => 'required',
        ]);
    
        $mulai_sewa = Carbon::parse($request->mulai_sewa);
        $akhir_sewa = Carbon::parse($request->akhir_sewa);
    
        // Tentukan jam operasional
        $jamBuka = Carbon::createFromTime(8, 0);  // 08:00
        $jamTutup = Carbon::createFromTime(22, 0); // 22:00
    
        // Validasi jam operasional
        if ($mulai_sewa->lt($jamBuka) || $akhir_sewa->gt($jamTutup)) {
            return redirect()->back()
                ->withErrors("Pemesanan hanya diperbolehkan antara jam {$jamBuka->format('H:i')} dan {$jamTutup->format('H:i')}.")
                ->withInput();
        }
    
        $total_jam = $mulai_sewa->diffInHours($akhir_sewa);
    
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $biaya = Biaya::where('kelas_lapangan', $lapangan->kelas_lapangan)->firstOrFail();
    
        // Validasi stok tersedia
        $stokTersedia = StokLapangan::where('biaya_id', $biaya->id)
        ->where('tanggal_sewa', $mulai_sewa->format('Y-m-d'))
        ->where(function ($query) use ($mulai_sewa, $akhir_sewa) {
            $query->whereBetween('mulai_sewa', [$mulai_sewa, $akhir_sewa])
                ->orWhereBetween('akhir_sewa', [$mulai_sewa, $akhir_sewa]);
        })
        ->sum('stok_tersedia');

        // Pastikan stok mencukupi
        // if ($stokTersedia < $request->stok_lapangan) {
        // return redirect()->back()->withErrors("Stok lapangan tidak mencukupi. Sisa stok: $stokTersedia")->withInput();
        // }
    
        // if ($stokTersedia >= $request->stok_lapangan) {
            if ($stokTersedia >= $request->stok_lapangan) {
            StokLapangan::where('biaya_id', $biaya->id)
                ->where('tanggal_sewa', $mulai_sewa->format('Y-m-d'))
                ->where(function ($query) use ($mulai_sewa, $akhir_sewa) {
                    $query->whereBetween('mulai_sewa', [$mulai_sewa, $akhir_sewa])
                          ->orWhereBetween('akhir_sewa', [$mulai_sewa, $akhir_sewa]);
                })
                ->decrement('stok_tersedia', $request->stok_lapangan);
                $biaya->decrement('stok_lapangan', $request->stok_lapangan);
                 // Kurangi stok pada tabel Biaya
        //    $biaya->decrement('stok', $request->stok_lapangan);
        } else {
            return redirect()->back()->withErrors("Stok lapangan tidak mencukupi. Sisa stok: $stokTersedia")->withInput();
        }

        $order_Id ='ORD-' . strtoupper(Str::random(10));
        // do {
        //     $penyewa->order_id = 'ORD-' . strtoupper(Str::random(10));
        // } while (self::where('order_id', $penyewa->order_id)->exists());
        // Simpan penyewa
        Penyewa::create([
            'order_id' => $order_Id, // Simpan order_id
            'nama_penyewa' => $request->nama_penyewa,
            'lapangan_id' => $request->lapangan_id,
            'total_jam' => $total_jam,
            'stok_lapangan' => $request->stok_lapangan,
            'mulai_sewa' => $mulai_sewa,
            'akhir_sewa' => $akhir_sewa,
            'tanggal_sewa' => now(),
            'biaya_lapangan' => $biaya->biaya_lapangan,
            'total_biaya' => $total_jam * $biaya->biaya_lapangan * $request->stok_lapangan,
            'user_id' => Auth::id(),
           'status_bayar' => 0,
        ]);
    
        return redirect()->route('backend.penyewa.index')->with('success', 'Penyewa berhasil ditambahkan.');

        // payment::create([
        //     'nama_penyewa' => $request->nama_penyewa,
        //     'lapangan_id' => $request->lapangan_id,
        //     'total_biaya' => $total_jam * $biaya->biaya_lapangan * $request->stok_lapangan,
           
        // ]);
    
        // return redirect()->route('backend.v_payment.index')->with('success', 'Penyewa berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        // Ambil data penyewa berdasarkan ID
        $penyewa = Penyewa::findOrFail($id);
        
        // Mengonversi 'mulai_sewa' dan 'akhir_sewa' ke format Carbon
        $penyewa->mulai_sewa = Carbon::parse($penyewa->mulai_sewa);
        $penyewa->akhir_sewa = Carbon::parse($penyewa->akhir_sewa);
        
        $lapangans = Lapangan::with('biaya')->get(); // Data lapangan untuk dropdown
        return view('backend.v_penyewa.edit', compact('penyewa', 'lapangans'));
    }

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'nama_penyewa' => 'required|string|max:255',
//         'lapangan_id' => 'required|exists:lapangan,id',
//         'stok_lapangan' => 'required|integer|min:1',
//         'mulai_sewa' => 'required|date',
//         'akhir_sewa' => 'required|date|after:mulai_sewa',
//         'status_bayar' => '',
//     ]);

//     // Ambil data penyewa
//     $penyewa = Penyewa::findOrFail($id);

//     // Ambil data lapangan dan biaya terkait
//     $lapangan = Lapangan::findOrFail($request->lapangan_id);
//     $biaya = Biaya::where('kelas_lapangan', $lapangan->kelas_lapangan)->first();

//     if (!$biaya) {
//         return redirect()->back()->withErrors('Biaya untuk kelas lapangan ini tidak ditemukan.');
//     }

//     // Hitung total jam
//     $mulai_Sewa = Carbon::parse($request->mulai_sewa);
//     $akhir_Sewa = Carbon::parse($request->akhir_sewa);
//     $total_Jam = $mulai_Sewa->diffInHours($akhir_Sewa);

//     // Cek stok tersedia di tabel biaya (pastikan stok tidak negatif setelah update)
//     $stokKembali = $penyewa->stok_lapangan; // Kembalikan stok penyewaan sebelumnya
//     $biaya->stok_lapangan += $stokKembali; // Pulihkan stok lama sebelum pengurangan

//     if ($biaya->stok_lapangan < $request->stok_lapangan) {
//         return redirect()->back()->withErrors('Stok lapangan tidak mencukupi. Sisa stok: ' . $biaya->stok_lapangan);
//     }

//     $biaya->stok_lapangan -= $request->stok_lapangan;
//     $biaya->save();

//     // Hitung total biaya
//     $totalBiaya = $total_Jam * $biaya->biaya_lapangan * $request->stok_lapangan;

//     // Update data penyewa
//     $penyewa->update([
//         'nama_penyewa' => $request->nama_penyewa,
//         'lapangan_id' => $request->lapangan_id,
//         'total_jam' => $total_Jam,
//         'stok_lapangan' => $request->stok_lapangan,
//         'mulai_sewa' => $mulai_Sewa,
//         'akhir_sewa' => $akhir_Sewa,
//         'tanggal_sewa' => now(),
//         'biaya_lapangan' => $biaya->biaya_lapangan,
//         'total_biaya' => $totalBiaya,
//         'status_bayar' => $request->status_bayar,
        
//     ]);

//     return redirect()->route('backend.penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
// }
public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama_penyewa' => 'required|string|max:255',
        'lapangan_id' => 'required|exists:lapangan,id',
        'stok_lapangan' => 'required|integer|min:1',
        'mulai_sewa' => 'required|date',
        'akhir_sewa' => 'required|date|after:mulai_sewa',
        'status_bayar' => 'required|in:0,1', // 0: Belum Bayar, 1: Sudah Bayar
    ]);

    // Ambil data penyewa
    $penyewa = Penyewa::findOrFail($id);

    // Ambil data lapangan dan biaya terkait
    $lapangan = Lapangan::findOrFail($request->lapangan_id);
    $biaya = Biaya::where('kelas_lapangan', $lapangan->kelas_lapangan)->firstOrFail();

    // Hitung total jam
    $mulaiSewa = Carbon::parse($request->mulai_sewa);
    $akhirSewa = Carbon::parse($request->akhir_sewa);
    $totalJam = $mulaiSewa->diffInHours($akhirSewa);

    // Validasi stok tersedia
    $stokLama = $penyewa->stok_lapangan; // Stok lama sebelum update
    $stokTersedia = StokLapangan::where('biaya_id', $biaya->id)
        ->where('tanggal_sewa', $mulaiSewa->format('Y-m-d'))
        ->where(function ($query) use ($mulaiSewa, $akhirSewa) {
            $query->whereBetween('mulai_sewa', [$mulaiSewa, $akhirSewa])
                ->orWhereBetween('akhir_sewa', [$mulaiSewa, $akhirSewa]);
        })
        ->sum('stok_tersedia');

    // Pulihkan stok lama sebelum pengurangan
    StokLapangan::where('biaya_id', $biaya->id)
        ->where('tanggal_sewa', $mulaiSewa->format('Y-m-d'))
        ->where(function ($query) use ($mulaiSewa, $akhirSewa) {
            $query->whereBetween('mulai_sewa', [$mulaiSewa, $akhirSewa])
                ->orWhereBetween('akhir_sewa', [$mulaiSewa, $akhirSewa]);
        })
        ->increment('stok_tersedia', $stokLama);

    // Pastikan stok mencukupi untuk permintaan baru
    if ($stokTersedia < $request->stok_lapangan) {
        return redirect()->back()->withErrors("Stok lapangan tidak mencukupi. Sisa stok: $stokTersedia")->withInput();
    }

    // Kurangi stok untuk permintaan baru
    StokLapangan::where('biaya_id', $biaya->id)
        ->where('tanggal_sewa', $mulaiSewa->format('Y-m-d'))
        ->where(function ($query) use ($mulaiSewa, $akhirSewa) {
            $query->whereBetween('mulai_sewa', [$mulaiSewa, $akhirSewa])
                ->orWhereBetween('akhir_sewa', [$mulaiSewa, $akhirSewa]);
        })
        ->decrement('stok_tersedia', $request->stok_lapangan);

    // Hitung total biaya
    $totalBiaya = $totalJam * $biaya->biaya_lapangan * $request->stok_lapangan;

    // Update data penyewa
    $penyewa->update([
        'nama_penyewa' => $request->nama_penyewa,
        'lapangan_id' => $request->lapangan_id,
        'total_jam' => $totalJam,
        'stok_lapangan' => $request->stok_lapangan,
        'mulai_sewa' => $mulaiSewa,
        'akhir_sewa' => $akhirSewa,
        'tanggal_sewa' => now(),
        'biaya_lapangan' => $biaya->biaya_lapangan,
        'total_biaya' => $totalBiaya,
        'status_bayar' => $request->status_bayar,
    ]);

    return redirect()->route('backend.penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
}


    /**
     * Hapus data penyewa.
     */
    public function destroy($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->delete();

        return redirect()->route('backend.penyewa.index')->with('success', 'Penyewa berhasil dihapus.');
    }



   
    public function formPenyewa()
    {
        return view('backend.v_penyewa.form', [
            'judul' => 'Laporan Data Penyewa',
        ]);
    }
    
    public function cetakPenyewa(Request $request)
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
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Menyesuaikan format tanggal akhir agar mencakup hari terakhir yang dipilih
    $tanggalAkhir = Carbon::parse($tanggalAkhir)->endOfDay();

    // Mengambil data penyewa berdasarkan range tanggal
    $penyewa = Penyewa::whereBetween('tanggal_sewa', [$tanggalAwal, $tanggalAkhir])
        ->orderBy('id', 'desc')
        ->get();

    return view('backend.v_penyewa.cetak', [
        'judul' => 'Laporan Penyewa',
        'tanggalAwal' => $tanggalAwal,
        'tanggalAkhir' => $tanggalAkhir,
        'cetak' => $penyewa,
    ]);
}
public function cetakStruk($order_id)
{
    $penyewa = Penyewa::where('order_id', $order_id)->first();

    if (!$penyewa) {
        return redirect()->route('backend.penyewa.index')->with('error', 'Data penyewa tidak ditemukan.');
    }

    $data = [
        'penyewa' => $penyewa,
        'tanggal_cetak' => now()->format('d-m-Y H:i'),
    ];

    return view('backend.v_penyewa.struk', $data);
}
public function show(Request $request)
{
    if ($request->ajax()) {
        $data = Penyewa::whereDate('mulai_sewa', '>=', $request->start)
            ->whereDate('akhir_sewa', '<=', $request->end)
            ->where('status_bayar', 1) // Tambahkan filter status_bayar = 1
            ->get(['id', 'nama_penyewa as title', 'mulai_sewa as start', 'akhir_sewa as end']);
        
        return response()->json($data);
    }
    return view('backend.v_penyewa.show');
}







public function ajax(Request $request)
{
    switch ($request->type) {
        case 'add':
            $penyewa = Penyewa::create([
                'nama_penyewa' => $request->title,
                'mulai_sewa'   => $request->start,
                'akhir_sewa'   => $request->end,
                'status_bayar' => 1, // Status dibayar (berhasil)
            ]);

            return response()->json($penyewa);
            break;

        case 'update':
            $penyewa = Penyewa::find($request->id)->update([
                'nama_penyewa' => $request->title,
                'mulai_sewa'   => $request->start,
                'akhir_sewa'   => $request->end,
            ]);

            return response()->json($penyewa);
            break;

        case 'delete':
            $penyewa = Penyewa::find($request->id)->delete();

            return response()->json($penyewa);
            break;

        default:
            return response()->json(['error' => 'Invalid operation type'], 400);
    }
}




}
