<?php

namespace App\Exports;

use App\Models\Buku;
use App\Exports\BukuExports;
use Maatwebsite\Excel\Concerns\FromCollection;

class BukuExports implements FromCollection
{
    public function collection()
    {
        return Buku::all();
    }
}
