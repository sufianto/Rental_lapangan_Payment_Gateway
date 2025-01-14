<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewa;

class TestController extends Controller
{
    //
    // function index(Request $request) {
        
    //     if ($request->ajax()) {
    //         # code...
    //         $data = Penyewa::whereDate('mulai_sewa', '>=', $request->start)
    //         ->whereDate('akhir_sewa', '<=', $request->end)
    //         ->get(['id', 'nama_penyewa as title', 'mulai_sewa as start', 'akhir_sewa as end']);
            
    //         return response()->json($data);
    //     }
    //     return view('test');
    // }
}
