<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $offer->customers->name }} Fatura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-5 mb-5">
        <a id="pdfDownloadLink" class="btn btn-primary mb-3" data-filename="{{ $offer->customers->name }}">PDF İndir</a>

        <div class="card">
            <div class="card-header">
                Fatura Hazırlanma Tarihi :
                <strong>{{ \Carbon\Carbon::parse($offer->date)->format('j-n-Y') }}</strong>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <img src="{{ asset('upload/avantaj.jpg') }}" class="img-fluid" width="240px" height="auto"
                            alt="">
                    </div>
                    <div class="col-sm-8">
                        <div>Ünvan: <b>AVANTAJ DEMİR SANAYİ TİCARET ANONİM ŞİRKETİ</b></div>
                        <div>Adres: </div>
                        <div>Vergi Dairesi / Numarası: <b>İLYASBEY VD / 104 173 5436</b></div>
                    </div>

                    <div class="col-sm-4">
                        <div>Teslim Tarihi:<b> {{ \Carbon\Carbon::parse($offer->delivery_date)->format('j-n-Y') }} </b>
                        </div>
                        <div>Nakliye Bedeli:
                            <b>
                                @if ($offer->person_to_pay_shipping_cost == 1)
                                    Alıcıya Aittir
                                @elseif ($offer->person_to_pay_shipping_cost == 2)
                                    Göndericiye Aittir
                                @endif
                            </b>
                        </div>
                    </div>



                </div>

                <div class="table-responsive-sm">
                    <table class="table mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Malzeme Adı</th>
                                <th>Boy</th>
                                <th>Adet</th>
                                <th>Birim Ağırlık</th>
                                <th>Toplam KG</th>
                                <th>Toplam Fiyat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grandTotalAmount = 0; // Toplam fiyatı sıfırla
                                $grandTotalWeight = 0; // Toplam kiloyu sıfırla
                                $withholdinggrandTotalAmount = 0;
                                $noholdinggrandTotalAmount = 0;
                                $totalwithholdingkdv = 0;
                                $totalnoholdingkdv = 0;
                                $lastgrandTotalAmount = 0;
                            @endphp
                            @foreach ($offerproducts as $offerproduct)
                                @php
                                    if ($offerproduct->type == 1) {
                                        $totalAmount = $offerproduct->unit_price * $offerproduct->quantity;
                                        $totalWeight = $offerproduct->quantity;
                                    } elseif ($offerproduct->type == 2) {
                                        $totalAmount = $offerproduct->quantity_weight * $offerproduct->quantity * $offerproduct->height * $offerproduct->unit_price;
                                        $totalWeight = $offerproduct->quantity_weight * $offerproduct->quantity * $offerproduct->height;
                                    } elseif ($offerproduct->type == 3) {
                                        $totalAmount = $offerproduct->quantity * $offerproduct->height * $offerproduct->unit_price;
                                        $totalWeight = $offerproduct->quantity * $offerproduct->height;
                                    }
                                    $grandTotalAmount += $totalAmount; // Toplam fiyatı güncelle
                                    $grandTotalWeight += $totalWeight; // Toplam kiloyu güncelle

                                    if ($offerproduct->withholding_status == 1) {
                                        $withholdinggrandTotalAmount += $totalAmount;
                                    }

                                    if ($offerproduct->withholding_status == 2) {
                                        $noholdinggrandTotalAmount += $totalAmount;
                                    }

                                    if ($offerproduct->withholding_status == 1) {
                                        $totalwithholdingkdv += ($totalAmount * $offerproduct->kdv) / 100;
                                    }

                                    if ($offerproduct->withholding_status == 2) {
                                        $totalnoholdingkdv += ($totalAmount * $offerproduct->kdv) / 100;
                                    }

                                    $lastgrandTotalAmount = $grandTotalAmount + $totalwithholdingkdv + $totalnoholdingkdv;
                                @endphp
                                <tr>
                                    <!-- Ürün bilgileri -->
                                    <th scope="row">{{ $number++ }}</th>
                                    <td>
                                        {{ $offerproduct->product->name }}
                                    </td>
                                    <td>{{ $offerproduct->height }} mt</td>
                                    <td>{{ $offerproduct->quantity }}</td>
                                    <td>{{ $offerproduct->quantity_weight }}</td>
                                    <td>{{ number_format($totalWeight, 2, ',', '.') }}</td>
                                    <td>{{ number_format($totalAmount, 2, ',', '.') }}TL
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Genel Toplam</strong>
                                    </td>
                                    <td class="right">{{ number_format($grandTotalAmount, 2, ',', '.') }} TL</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Tevkifatlı Ara Toplam </strong>
                                    </td>
                                    <td class="right">{{ number_format($withholdinggrandTotalAmount, 2, ',', '.') }}
                                        TL</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Tevkifatsız Ara Toplam</strong>
                                    </td>
                                    <td class="right">{{ number_format($noholdinggrandTotalAmount, 2, ',', '.') }} TL
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Tevkifatlı KDV</strong>
                                    </td>
                                    <td class="right">
                                        {{ number_format($totalwithholdingkdv, 2, ',', '.') }} TL
                                    </td>
                                </tr>

                                <tr>
                                    <td class="left">
                                        <strong>KDV</strong>
                                    </td>
                                    <td class="right">
                                        {{ number_format($totalnoholdingkdv, 2, ',', '.') }} TL
                                    </td>
                                </tr>

                                <tr>
                                    <td class="left">
                                        <strong>Toplam Fiyat</strong>
                                    </td>
                                    <td class="right" style="font-size: 18px;">
                                        <strong>{{ number_format($lastgrandTotalAmount, 2, ',', '.') }} TL</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.0/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById('pdfDownloadLink').addEventListener('click', function(e) {
            e.preventDefault();

            const element = document.querySelector('.card');
            const filename = this.getAttribute('data-filename') + '.pdf'; // Dinamik dosya adını oluşturun

            const options = {
                filename: filename,
            };

            html2pdf().from(element).set(options).save();
        });
    </script>
</body>

</html>
