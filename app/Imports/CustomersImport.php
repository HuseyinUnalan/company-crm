<?php

namespace App\Imports;

use App\Models\Customers;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');
     
        return new Customers([

            'name' => $row[0],
            'phone' => $row[1],
            'email' => $row[2],
            'address' => $row[3],
            'tax_number' => $row[4],
            'tax_administration' => $row[5],
            'slug' => strtolower(str_replace($search, $replace, $row[0])),
            'user_id' => auth()->user()->id,
            
        ]);
    }
}
