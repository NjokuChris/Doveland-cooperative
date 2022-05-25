<?php

namespace App\Imports;

use App\Models\Contribution;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContributionsImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
           // dd($row);
        return new Contribution([
            'member_id'  => $row['member_id'],
            'month_id'   => $row['month_id'],
            'amount'     => $row['amount'],
        ]);
    }
}
