<?php

namespace App\Exports;

use App\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PerusahaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Perusahaan::all();
    }
}
