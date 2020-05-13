<?php

namespace App\Exports;

use App\Email;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmailExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Email::all();
    }
}
