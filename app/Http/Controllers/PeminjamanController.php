<?php

namespace App\Http\Controllers;
use App\Models\peminjam;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index(Request $request)
{

    $user = Auth::user();
    
    $peminjaman = Peminjam::where('user_id', $user->id)->get();

    return view('dashboard.peminjaman.index')
        ->with([
            'title' => 'Buku Yang Kamu Pinjam',
            'active' => 'Peminjaman',
            'peminjaman' => $peminjaman
    ]);

}

    public function admin(Request $request)
    {
       
        $peminjaman = Peminjam::all();

        return view('dashboard.peminjamanAdmin')
            ->with([
                'title' => 'Buku Yang Kamu Pinjam',
                'active' => 'Peminjaman',
                'peminjaman' => $peminjaman
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'nullable',
            'tanggal_kembali' => 'nullable',
        ]);

        Peminjam::create([
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'status' => 'Dipinjam',
            'tanggal_pinjam' => $request->input('tanggal_pinjam'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
        ]);
        
        toast('Berhasil ditambahkan ke Peminjaman!', 'success');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    { 
        // dd($request->all());
        $request->validate([
            'status' => 'required',
            'tanggal_kembali' => 'required'
        ]);
    
        try {
            $peminjaman = Peminjam::findOrFail($id);
    
            $peminjaman->update([
                'tanggal_kembali' =>$request->input('tanggal_kembali'), // Mengisi tanggal pengembalian dengan tanggal saat ini
                'status' => 'Dikembalikan',
            ]);
    
            toast('Buku berhasil dikembalikan!', 'success');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            toast('Peminjaman tidak ditemukan', 'error');
        } catch (\Exception $e) {
            toast('Terjadi kesalahan saat mengembalikan buku', 'error');
        }
    
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        toast('Berhasil dihapus dari peminjaman.', 'success');

        return redirect()->back();
    }

    public function exportPdf()
    {
        $peminjaman = Peminjam::all();
        $pdf = Pdf::loadView('pdf.export-peminjaman', ['peminjaman' => $peminjaman]);
        return $pdf->download('peminjaman.pdf');
    }
}