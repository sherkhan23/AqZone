<?php

namespace App\Exports;

use App\Models\Aids;
use Maatwebsite\Excel\Concerns\FromCollection;

class AidsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aids::all();
    }
}
