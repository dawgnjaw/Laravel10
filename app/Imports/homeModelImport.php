<?php

namespace App\Imports;

use App\Models\homeModel;
use Maatwebsite\Excel\Concerns\ToModel;

class homeModelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new homeModel([
            'name' => $row[1],
            'age' => $row[2],
            'adress' => $row[3],
            'foto' => $row[4],
        ]);
    }
}
