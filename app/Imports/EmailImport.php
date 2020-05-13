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
            'email'    => $row[1],//TODO Why is this not working the documentation way, and why is it working my way?
            //https://docs.laravel-excel.com/3.1/imports/
            'active'   => $row[2],
            'customer' => $row[3],
        ]);
    }
}
