<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $anggota = Anggota::orderBy('id', 'desc')->get();
    return view('v_anggota.index', [
    'judul' => 'Data Anggota',
    'index' => $anggota
    ]);
    }
    /**

    
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('v_anggota.create', [
    'judul' => 'Tambah Anggota'
    ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debugging request data
        // dd($request);
        // atau untuk lebih banyak informasi debugging
        // ddd($request);
        $validatedData = $request->validate([
        'nama' => 'required|max:255',
        'hp' => 'required|min:10|max:13',
        ]);
        Anggota::create($validatedData);
        return redirect('/anggota');

        

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
        $anggota = Anggota::find($id);
        return view('v_anggota.edit', [
        'judul' => 'Ubah Anggota',
        'edit' => $anggota
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama' => 'required|max:100',
            'hp' => 'required|min:10|max:13',
            ];
            $validatedData = $request->validate($rules);
            Anggota::where('id', $id)->update($validatedData);
            return redirect('/anggota');
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
$anggota->delete();
return redirect('/anggota');
    }
}
