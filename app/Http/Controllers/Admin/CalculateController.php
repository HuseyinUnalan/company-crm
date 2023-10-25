<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\OfferDetail;
use App\Models\Offers;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function Calculate()
    {
        $userid = auth()->user()->id;
        $customers = Customers::where('user_id', $userid)->get();
        $products = Products::where('user_id', $userid)->get();
        return view('admin.calculations.calculate', compact('customers', 'products'));
    }

    public function getProductDetailsAjax($id)
    {
        $product = Products::find($id);

        // Eğer ürün varsa, JSON olarak ürün detaylarını döndürüyoruz
        if ($product) {
            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'withholding_status' => $product->withholding_status,
                'unit_price' => $product->unit_price,
                'kdv' => $product->kdv,
                'quantity_weight' => $product->quantity_weight,
                'height' => $product->height,
                'quantity' => $product->quantity,
                'type' => $product->type,




                // Diğer ürün detaylarını burada ekleyebilirsiniz
            ]);
        } else {
            // Eğer ürün bulunamazsa hata mesajı döndürüyoruz
            return response()->json(['error' => 'Ürün bulunamadı.'], 404);
        }
    }

    public function StoreCalculate(Request $request)
    {
        // Gizli input alanından JSON olarak alınan ürün satış verilerini çözümlüyoruz
        $salesData = json_decode($request->input('sales_data'), true);
        $userid = auth()->user()->id;
        // Eğer $salesData boş veya hatalı ise geriye hata mesajı döndür
        if (!$salesData || !is_array($salesData)) {
            // return response()->json(['error' => 'Ürün satış verileri geçersiz.'], 400);
            $notification = array(
                'message' => 'Başarısız!',
                'alert-type' => 'danger'
            );
            // Başarıyla kaydedildiğine dair mesaj döndür
            return redirect()->back()->with($notification);
        }

        // Sales tablosuna toplam fiyatı kaydetmek için değişken oluşturalım
        $totalPrice = 0;

        // Sales tablosuna kayıt yapalım ve dönen id'yi alalım
        $sales = new Offers();
        // $sales->total_price = 0; // Önce toplam fiyatı 0 olarak atayalım, aşağıda güncelleyeceğiz
        $sales->customer_id = $request->customer_id;
        $sales->user_id = $userid;
        $sales->date = Carbon::now();
        $sales->save();
        $salesId = $sales->id; // Dönen id'yi alalım

        // Ürün satış verilerini döngü ile dolaşarak sales_products tablosuna ve sales tablosuna kaydediyoruz
        foreach ($salesData as $data) {
            $salesProduct = new OfferDetail();

            $salesProduct->sales_id = $salesId; // SalesProduct tablosundaki sales_id sütununa dönen id'yi atayalım
            $salesProduct->product_id = $data['productId'];
            $salesProduct->quantity = $data['quantity'];
            $salesProduct->kdv = $data['kdv'];
            $salesProduct->unit_price = $data['unit_price'];
            $salesProduct->discount = $data['discount'];
            $salesProduct->amount = $data['amount'];
            $salesProduct->total_price = $data['netAmount'];
            $salesProduct->total = $data['total'];

            $salesProduct->height = $data['height'];
            $salesProduct->quantity_weight = $data['quantity_weight'];
            $salesProduct->withholding_status = $data['withholding_status'];
            $salesProduct->type = $data['type'];


            $salesProduct->date = Carbon::now();
            $salesProduct->customer_id = $request->customer_id;
            $salesProduct->user_id = $userid;


            // SalesProduct tablosuna kayıt yapalım
            $salesProduct->save();

            // Toplam fiyatı güncelleyelim
            $totalPrice += $data['total'];
        }

        $notification = array(
            'message' => ' Başarıyla Kaydedildi',
            'alert-type' => 'success'
        );
        // Başarıyla kaydedildiğine dair mesaj döndür
        return redirect()->back()->with($notification);
    }

    public function MyOffers()
    {
        $userid = auth()->user()->id;
        $offers = Offers::where('user_id', $userid)->get();
        return view('admin.calculations.my_offers', compact('offers'));
    }

    public function DetailOffer($id, $user_id)
    {
        $offer = Offers::where('id', $id)
            ->where('user_id', $user_id)
            ->first();
        $offerproducts = OfferDetail::where('sales_id', $id)->get();
        $number = 1;

        return view('admin.calculations.detail_offer', compact('offer', 'offerproducts', 'number'));
    }

    public function DeleteOffer($id)
    {
        $offers = Offers::findOrFail($id)->get();

        foreach ($offers as $offer) {
            OfferDetail::where('sales_id', $offer->id)->delete();
        }

        Offers::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Başarıyla Silindi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
