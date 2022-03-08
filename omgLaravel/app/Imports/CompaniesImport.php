<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CompaniesImport implements ToModel, WithCustomCsvSettings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Company([
            'name' => $row[0],
            'category_id' => $row[1],
            'code' => $row[2],
            'vat' => $row[3],
            'address' => $row[4].' ,'.$row[5],
            'head' => $row[6],
            'description' => $row[7],
            'logo' => $row[8]
        ]);
    }
}
