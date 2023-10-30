<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\ProductCategories;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{


    public function AllProducts()
    {
        $userid = auth()->user()->id;
        $products = Products::where('user_id', $userid)->get();
        $productcategories = ProductCategories::where('user_id', $userid)->get();
        return view('admin.products.all_products', compact('products', 'productcategories'));
    }

    public function AddProduct()
    {
        $userid = auth()->user()->id;
        $productcategories = ProductCategories::where('user_id', $userid)->get();
        return view('admin.products.add_products', compact('productcategories'));
    }


    public function StoreProduct(Request $request)
    {
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $save_url = $data['photo'] = 'upload/products/' . $filename;
        }

        if ($request->withholding_status == 1) {
            $kdv = $request->entered_kdv / 2;
        } else if ($request->withholding_status == 2) {
            $kdv = $request->entered_kdv;
        }

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');


        Products::insert([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
            'type' => $request->type,
            'quantity_weight' => $request->quantity_weight,
            'entered_kdv' => $request->entered_kdv,
            'kdv' => $kdv,
            'withholding_status' => $request->withholding_status,
            'height' => $request->height,
            'category' => $request->category,
            'discount' => $request->discount,
            'entered_unit_price' => $request->entered_unit_price,
            'unit_price' => $request->entered_unit_price - ($request->entered_unit_price * $request->discount / 100),
            'general_discount_product' => $request->general_discount_product,
            'photo' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Ürün Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }

    public function EditProduct($id)
    {
        $product = Products::find($id);
        $userid = auth()->user()->id;
        $productcategories = ProductCategories::where('user_id', $userid)->get();
        return view('admin.products.edit_products', compact('product', 'productcategories'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;
        $old_img = $request->old_image;

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');

        $save_url = $request->old_image;

        if ($request->withholding_status == 1) {
            $kdv = $request->entered_kdv / 2;
        } else if ($request->withholding_status == 2) {
            $kdv = $request->entered_kdv;
        }

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink($old_img);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $save_url = $data['photo'] = 'upload/products/' . $filename;
        }
        Products::findOrFail($product_id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
            'type' => $request->type,
            'quantity_weight' => $request->quantity_weight,
            'entered_kdv' => $request->entered_kdv,
            'kdv' => $kdv,
            'height' => $request->height,
            'withholding_status' => $request->withholding_status,
            'category' => $request->category,
            'discount' => $request->discount,
            'entered_unit_price' => $request->entered_unit_price,
            'unit_price' => $request->entered_unit_price - ($request->entered_unit_price * $request->discount / 100),
            'general_discount_product' => $request->general_discount_product,
            'photo' =>  $save_url,
        ]);

        $notification = array(
            'message' => 'Ürün Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $products = Products::findorFail($id);
        $img = $products->photo;
        if (isset($img)) {
            unlink($img);
        }
        Products::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Ürün Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function AddProductExcel()
    {
        return view('admin.products.products_excel_import');
    }

    public function StoreProductExcel(Request $request)
    {
        $file = $request->file;



        if ($file) {

            try {
                Excel::import(new ProductsImport, $file);

                $notification = array(
                    'message' => 'Ekleme Başarılı.',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            } catch (\Exception $ex) {
                // $notification = array(
                //     'message' => 'Ekleme Başarısız.',
                //     'alert-type' => 'danger'
                // );

                // return redirect()->back()->with($notification);
                dd($ex);
            }
        }
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'ürünlerim.xlsx');
    }

    public function updateDiscount(Request $request)
    {
        $categoryId = $request->input('category_id');
        $discountValue = $request->input('discount_value');

        // Kategoriye ait ürünleri al
        $products = Products::where('category', $categoryId)->get();

        // Ürünleri döngüye al ve işlemleri yap
        foreach ($products as $product) {
            // İskonto işlemleri burada yapılır
            if ($product->general_discount_product == 1) {
                $product->discount = $discountValue;
                $product->unit_price = $product->entered_unit_price - ($product->entered_unit_price * $discountValue / 100);
                $product->save();
            }
        }

        return redirect()->back()->with('success', 'İskonto güncellendi');
    }
}
