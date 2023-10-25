<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Offers;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function AllCustomers()
    {
        $customers = Customers::all();
        return view('admin.superadmin.all_customers', compact('customers'));
    }

    public function AllProducts()
    {
        $products = Products::all();
        return view('admin.superadmin.all_products', compact('products'));
    }

    public function AllUsers()
    {
        $users = User::all();
        return view('admin.superadmin.all_users', compact('users'));
    }

    public function DetailUser($id) {
        $user = User::find($id);
        return view('admin.superadmin.user_detail', compact('user'));

    }

    public function AllOffers() {
        $offers = Offers::all();
        return view('admin.superadmin.all_offers', compact('offers'));
    }
}
