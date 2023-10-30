<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserIBAN;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserIBANController extends Controller
{
    public function AllUserIBAN()
    {
        $userid = auth()->user()->id;
        $useribans = UserIBAN::where('user_id', $userid)->get();
        return view('admin.useriban.all_user_iban', compact('useribans'));
    }

    public function AddUserIBAN()
    {
        return view('admin.useriban.add_user_iban');
    }


    public function StoreUserIBAN(Request $request)
    {
        UserIBAN::insert([
            'bank_name' => $request->bank_name,
            'iban' => $request->iban,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'IBAN Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user.iban')->with($notification);
    }

    public function EditUserIBAN($id)
    {
        $useriban = UserIBAN::find($id);
        $userid = auth()->user()->id;
        return view('admin.useriban.edit_user_iban', compact('useriban'));
    }

    public function UpdateUserIBAN(Request $request)
    {
        $useriban_id = $request->id;

        UserIBAN::findOrFail($useriban_id)->update([
            'bank_name' => $request->bank_name,
            'iban' => $request->iban,
        ]);

        $notification = array(
            'message' => 'IBAN Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteUserIBAN($id)
    {
        UserIBAN::findOrFail($id)->delete();

        $notification = array(
            'message' => 'IBAN Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
