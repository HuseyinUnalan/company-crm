<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {

        return new Products([
            'category' => $row[0],
            'name' => $row[1],
            'height' => $row[2],
            'type' => $row[3],
            'quantity_weight' => $row[4],
            'entered_unit_price' => $row[5],
            'discount' => $row[6],
            'entered_kdv' => $row[7],
            'withholding_status' => $row[8],
            'user_id' => auth()->user()->id,
            'unit_price' => $row[5] - ($row[5] * $row[6] / 100),
            'kdv' => ($row[8] == 1) ? ($row[7] / 2) : $row[7],
        ]);
    }
}
