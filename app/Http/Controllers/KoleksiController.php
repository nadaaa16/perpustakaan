<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $koleksi = Koleksi::with(['buku', 'buku.kategori'])
            ->where('user_id', $user)
            ->latest()
            ->get();

        confirmDelete('Hapus Koleksi?', 'Anda yakin ingin hapus Buku dari Koleksi?');

        return view('dashboard.koleksi.index')
            ->with([
                'title' => 'Koleksi Buku Kamu',
                'active' => 'Koleksi',
                'koleksi' => $koleksi
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'buku_id' => 'required',
    ]);

    Koleksi::create([
        'user_id' => $request->input('user_id'),
        'buku_id' => $request->input('buku_id'),
        // 'tanggal_pinjam' => now()->toDateString()
    ]);

    toast('Berhasil ditambahkan ke Koleksi!', 'success');

    return redirect()->back();
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Koleksi $koleksi)
    {
        // if (auth()->user()->hasRole('admin')) {
        //     toast('Anda tidak diizinkan menghapus data.', 'error');
        //     return redirect()->back();
        // }

        $koleksi->delete();
        
        toast('Buku telah dihapus dari Koleksi.', 'success');

        return redirect()->back();
    }
}
