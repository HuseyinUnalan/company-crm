<?php

namespace App\Exports;

use App\Models\Customers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class CustomersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Products tablosundan gerekli sütunları seçin ve verileri alın
        $data = Customers::select('name', 'phone', 'email', 'address', 'tax_number', 'tax_administration')->get();
        return new Collection($data);
    }
}
