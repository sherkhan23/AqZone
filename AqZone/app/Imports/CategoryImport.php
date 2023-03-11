<?php

namespace App\Imports;

use App\Models\Categories;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;


class CategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Categories([
            'id'     => $row[0],
            'categoryName'    => $row[1],
            'details' => $row[2],
            'created_at' => $row[3],
            'updated_at' => $row[4]
        ]);
    }
}
