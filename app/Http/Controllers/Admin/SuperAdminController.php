<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blogs;
use App\Models\Customers;
use App\Models\Offers;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Sliders;
use App\Models\User;
use Carbon\Carbon;
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

    public function DetailUser($id)
    {
        $user = User::find($id);
        return view('admin.superadmin.user_detail', compact('user'));
    }

    public function AllOffers()
    {
        $offers = Offers::all();
        return view('admin.superadmin.all_offers', compact('offers'));
    }


    // About Section Controller

    public function EditAbout()
    {
        $about = About::find(1);
        return view('admin.about.edit_about', compact('about'));
    }


    public function UpdateAbout(Request $request)
    {
        $data = About::find(1);
        $data->title = $request->title;
        $data->description = $request->description;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink($data->photo);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/about'), $filename);
            $data['photo'] = 'upload/about/' . $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Hakkımızda Sayfası Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->route('edit.about')->with($notification);
    }

    // Settings Section Controller

    public function SettingsEdit()
    {
        $settings = Settings::find(1);
        return view('admin.settings.edit_settings', compact('settings'));
    }

    public function SettingsStore(Request $request)
    {

        $settings = Settings::find(1);
        $settings->site_title = $request->site_title;
        $settings->site_description = $request->site_description;
        $settings->site_keywords = $request->site_keywords;
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->whatsapp = $request->whatsapp;
        $settings->map = $request->map;


        if ($request->file('logo')) {
            $file = $request->file('logo');
            @unlink(public_path($settings->logo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/logos'), $filename);
            $settings['logo'] = 'upload/logos/' . $filename;
        }

        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            @unlink(public_path($settings->favicon));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/logos'), $filename);
            $settings['favicon'] = 'upload/logos/' .  $filename;
        }
       

        $settings->save();

        $notification = array(
            'message' => 'Genel Ayarlar Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Slider Section Controller

    public function AllSlider()
    {
        $slider = Sliders::latest()->get();
        return view('admin.sliders.all_slider', compact('slider'));
    }

    public function AddSlider()
    {
        return view('admin.sliders.add_slider');
    }

    public function StoreSlider(Request $request)
    {
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/slider'), $filename);
            $save_url = $data['photo'] = 'upload/slider/' . $filename;
        }

        Sliders::insert([
            'title' => $request->title,
            'desk' => $request->desk,
            'photo' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Slider Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }

    public function EditSlider($id)
    {
        $slider = Sliders::findOrFail($id);
        return view('admin.sliders.edit_slider', compact('slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_image;

        $save_url = $request->old_image;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink($old_img);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/slider'), $filename);
            $save_url = $data['photo'] = 'upload/slider/' . $filename;
        }
        Sliders::findOrFail($slider_id)->update([
            'title' => $request->title,
            'desk' => $request->desk,
            'photo' =>  $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteSlider($id)
    {
        $slider = Sliders::findorFail($id);
        $img = $slider->photo;
        if (isset($img)) {
            unlink($img);
        }
        Sliders::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function SliderInactive($id)
    {
        Sliders::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Slider Yayından Kaldırıldı',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function SliderActive($id)
    {
        Sliders::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider Yayına Alındı',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    // Blog Section Controller

    public function AllBlog()
    {
        $blog = Blogs::latest()->get();
        return view('admin.blog.all_blog', compact('blog'));
    }

    public function AddBlog()
    {
        return view('admin.blog.add_blog');
    }

    public function StoreBlog(Request $request)
    {
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/blogs'), $filename);
            $save_url = $data['photo'] = 'upload/blogs/' . $filename;
        }

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');


        Blogs::insert([
            'title' => $request->title,
            'title_slug' => strtolower(str_replace($search, $replace, $request->title)),
            'description' => $request->description,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'desk' => $request->desk,
            'photo' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Eklendi',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blog = Blogs::findOrFail($id);
        return view('admin.blog.edit_blog', compact('blog'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;
        $old_img = $request->old_image;

        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '/');
        $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '-');

        $save_url = $request->old_image;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink($old_img);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/blogs'), $filename);
            $save_url = $data['photo'] = 'upload/blogs/' . $filename;
        }
        Blogs::findOrFail($blog_id)->update([
            'title' => $request->title,
            'title_slug' => strtolower(str_replace($search, $replace, $request->title)),
            'description' => $request->description,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'desk' => $request->desk,
            'photo' =>  $save_url,
        ]);

        $notification = array(
            'message' => 'Blog Güncellendi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteBlog($id)
    {
        $blogs = Blogs::findorFail($id);
        $img = $blogs->photo;
        if (isset($img)) {
            unlink($img);
        }
        Blogs::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Başarıyla Silindi',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function BlogInactive($id)
    {
        Blogs::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Blog Yayından Kaldırıldı',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function BlogActive($id)
    {
        Blogs::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Blog Yayına Alındı',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
