<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProducts()
    {
        $products = Products::all();
        return view('admin.products.all_products', compact('products'));
    }

    public function AddProduct()
    {
        return view('admin.products.add_products');
    }


    public function StoreProduct(Request $request)
    {
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $save_url = $data['photo'] = 'upload/products/' . $filename;
        }

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');


        Products::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
            'type' => $request->description,
            'unit_price' => $request->unit_price,
            'quantity_weight' => $request->quantity_weight,
            'kdv' => $request->kdv,
            'withholding_status' => $request->withholding_status,
            'height' => $request->height,
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
        return view('admin.products.edit_products', compact('product'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;
        $old_img = $request->old_image;

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');

        $save_url = $request->old_image;

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
            'type' => $request->description,
            'unit_price' => $request->unit_price,
            'quantity_weight' => $request->quantity_weight,
            'kdv' => $request->kdv,
            'height' => $request->height,
            'withholding_status' => $request->withholding_status,
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
}
