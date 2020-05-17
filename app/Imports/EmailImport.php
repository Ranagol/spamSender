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
            'email'    => $row[1],//TODO This is one, because in the excel the id's are in the first (0th) row, and we don't want to import ids. Put this into puska, it will be important, because this way we can controll row...
            'active'   => $row[2],//TODO this 2 number means number of the column in the excel that will be imported??
            'customer' => $row[3],
        ]);
    }
}
