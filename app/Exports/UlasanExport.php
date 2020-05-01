<?php

namespace App\Exports;

use App\Ulasan;
use Maatwebsite\Excel\Concerns\FromCollection;

class UlasanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ulasan::all();
    }
}
