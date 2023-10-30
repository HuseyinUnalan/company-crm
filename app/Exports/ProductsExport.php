<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class ProductsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Products tablosundan gerekli sütunları seçin ve verileri alın
        $data = Products::select('category', 'name', 'height', 'type', 'quantity_weight', 'entered_unit_price', 'discount', 'entered_kdv', 'withholding_status')->get();

        // Verileri döngüye alarak ilgili kategori adlarını alın ve 'type' sütununu dönüştürün
        $data->each(function ($product) {
            $category = $product->categoryRelation->name; // Burada "categoryRelation" ilişkiyi temsil etmelidir
            $product->category = $category; // "category" sütunu adını güncelleyin

            // 'type' sütununu dönüştürün
            switch ($product->type) {
                case 1:
                    $product->type = 'Adet';
                    break;
                case 2:
                    $product->type = 'Ağırlık';
                    break;
                case 3:
                    $product->type = 'Metre';
                    break;
                case 4:
                    $product->type = 'Diğer';
                    break;
                default:
                    $product->type = 'Bilinmeyen';
                    break;
            }

            // 'withholding_status' sütununu dönüştürün
            switch ($product->withholding_status) {
                case 1:
                    $product->withholding_status = 'Var';
                    break;
                case 2:
                    $product->withholding_status = 'Yok';
                    break;
                default:
                    $product->withholding_status = 'Bilinmeyen';
                    break;
            }
        });

        // Kategori sütununu silerek elde edilen veriyi Laravel koleksiyonuna dönüştürün
        $data->each(function ($item) {
            unset($item->categoryRelation);
        });

        return new Collection($data);
    }
}
