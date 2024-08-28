<?php

namespace App\Exports;

use App\Models\homeModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class homeModelExport implements FromCollection
{
    /**
    *@return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return homeModel::all();
    }
}
