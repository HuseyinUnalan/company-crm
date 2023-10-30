<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Offers;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function Index()
    {
        $userid = auth()->user()->id;
        $productCount = Products::where('user_id', $userid)->count();
        $customerCount = Customers::where('user_id', $userid)->count();
        $myoffersCount = Offers::where('user_id', $userid)->count();
        $userCount = User::count();
        return view('admin.index', compact('productCount', 'customerCount', 'userCount', 'myoffersCount'));
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->tax_number = $request->tax_number;
        $data->tax_administration = $request->tax_administration;
        $data->address = $request->address;



        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            @unlink(public_path('upload/admin_images/' . $data->profile_image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profil Başarıyla Güncellendi',
            'alert-type' => 'success'
        );


        return redirect()->route('edit.profile')->with($notification);
    }

    public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Şifre Başarıyla Güncellendi');
            return redirect()->back();
        } else {
            session()->flash('message', 'Eski Şifre Eşleşmiyor');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout(); // Kullanıcıyı oturumdan çıkart

        return Redirect::route('login'); // Çıkış yaptıktan sonra yönlendirilecek sayfa
    }

   
}
