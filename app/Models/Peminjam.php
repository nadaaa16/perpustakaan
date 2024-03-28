<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'status']; // Tambahkan 'tanggal-peminjam' ke dalam fillable

    protected $primaryKey = 'id';

    protected $table = 'peminjam';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}