<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blogs;
use App\Models\Customers;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Sliders;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index()
    {
        $sliders = Sliders::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();
        $blogs = Blogs::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();

        $about = About::find(1);
        $settings = Settings::find(1);
        return view('frontend.index', compact('sliders', 'blogs', 'about', 'settings'));
    }
    public function AddOffer()
    {
        $userid = auth()->user()->id;
        $customers = Customers::where('user_id', $userid)->get();
        $products = Products::where('user_id', $userid)->get();

        $blogs = Blogs::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();
        $settings = Settings::find(1);
        return view('frontend.add_offer', compact('customers', 'products', 'blogs', 'settings'));
    }


    public function HomeAbout()
    {
        $about = About::find(1);
        $settings = Settings::find(1);
        return view('frontend.pages.about', compact('about', 'settings'));
    }

    public function HomeContact()
    {
        $settings = Settings::find(1);
        return view('frontend.pages.contact', compact('settings'));
    }

    //Contact Page 
    // public function StoreMesseage(Request $request)
    // {
    //     Messages::insert([

    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'subject' => $request->subject,
    //         'message' => $request->message,
    //         'created_at' => Carbon::now(),

    //     ]);
    //     return redirect()->route('home.contact')->with('success', 'Mesaj Başarıyla Gönderildi.');
    // }
    public function HomeBlog()
    {
        $blogs = Blogs::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();
        $settings = Settings::find(1);
        $about = About::find(1);
        return view('frontend.pages.all_blog', compact('blogs', 'settings', 'about'));
    }

    public function BlogDetail($slug)
    {
        $blogs = Blogs::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();
        $blog = Blogs::wheretitle_slug($slug)->firstOrFail();
        $settings = Settings::find(1);
        $about = About::find(1);
        return view('frontend.pages.blog_details', compact('blog', 'blogs', 'settings', 'about'));
    }
}
