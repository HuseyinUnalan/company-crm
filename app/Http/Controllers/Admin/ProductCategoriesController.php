<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function AllProductCategories()
    {
        $userid = auth()->user()->id;
        $productcategories = ProductCategories::where('user_id', $userid)->get();
        return view('admin.productcategories.all_product_categories', compact('productcategories'));
    }

    public function AddProductCategory()
    {
        return view('admin.productcategories.add_product_categories');
    }


    public function StoreProductCategory(Request $request)
    {


        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');


        ProductCategories::insert([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Ürün Kategori Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product.categories')->with($notification);
    }

    public function EditProductCategory($id)
    {
        $productcategory = ProductCategories::find($id);
        return view('admin.productcategories.edit_product_categories', compact('productcategory'));
    }

    public function UpdateProductCategory(Request $request)
    {
        $productcategory_id = $request->id;

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');

        ProductCategories::findOrFail($productcategory_id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
        ]);

        $notification = array(
            'message' => 'Ürün Kategori Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProductCategory($id)
    {

        ProductCategories::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ürün Kategori Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
