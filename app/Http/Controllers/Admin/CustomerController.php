<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function AllCustomers()
    {
        $customers = Customers::all();
        return view('admin.customers.all_customers', compact('customers'));
    }

    public function AddCustomer()
    {
        return view('admin.customers.add_customer');
    }


    public function StoreCustomer(Request $request)
    {
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $save_url = $data['photo'] = 'upload/products/' . $filename;
        }

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');


        Customers::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Müşteri Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customers')->with($notification);
    }

    public function EditCustomer($id)
    {
        $customer = Customers::find($id);
        return view('admin.customers.edit_customer', compact('customer'));
    }

    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');

        Customers::findOrFail($customer_id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace($search, $replace, $request->name)),
        ]);

        $notification = array(
            'message' => 'Müşteri Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteCustomer($id)
    {
       
        Customers::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Müşteri Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
