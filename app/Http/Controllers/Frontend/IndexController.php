<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blogs;
use App\Models\Customers;
use App\Models\Messages;
use App\Models\OfferDetail;
use App\Models\Offers;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Sliders;
use Carbon\Carbon;
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
        $customersCount = Customers::where('user_id', $userid)->count();
        $products = Products::all();

        $blogs = Blogs::where('status', 1) // status sütunu 1 olanları seç
            ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
            ->get();
        $settings = Settings::find(1);
        return view('frontend.offers.add_offer', compact('customers', 'products', 'blogs', 'settings', 'customersCount'));
    }

    public function MyOffersFront()
    {
        $userid = auth()->user()->id;
        $offers = Offers::where('user_id', $userid)
            ->orderBy('created_at', 'desc') // 'created_at' sütununa göre azalan sıralama
            ->get();

        $settings = Settings::find(1);
        return view('frontend.offers.my_offers', compact('offers', 'settings'));
    }


    public function DetailOfferFront($id, $user_id)
    {
        $offer = Offers::where('id', $id)
            ->where('user_id', $user_id)
            ->first();
        $offerproducts = OfferDetail::where('sales_id', $id)->get();
        $number = 1;

        $settings = Settings::find(1);
        return view('frontend.offers.detail_offer', compact('offer', 'offerproducts', 'number', 'settings'));
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

    // Contact Page 
    public function StoreMesseage(Request $request)
    {
        Messages::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('home.contact')->with('success', 'Mesaj Başarıyla Gönderildi.');
    }


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
