<?php

namespace App\Imports;

use App\Email;
use Maatwebsite\Excel\Concerns\ToModel;

class EmailImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Email([
            'email'    => $row[1],//This is one, because in the excel the id's are in the first (0th) row, and we don't want to import ids. 
            'active'   => $row[2],
            'customer' => $row[3],
        ]);
    }
}
