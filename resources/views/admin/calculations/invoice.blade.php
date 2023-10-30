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

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <img src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/no_image.jpg') }}"
                            class="img-fluid" width="100%" height="auto" alt="">
                    </div>
                    <div class="col-md-4 mt-5">
                        <h3 class="text-center">{{ $adminData->name }}</h3>
                    </div>

                    <div class="col-md-2 mt-5">
                        <h6 class="text-center"> .../.../ 20...</h6>
                    </div>
                    <hr>

                    <div class="col-sm-6 mt-3 p-3" style="border: 1px solid black;">
                        <div>
                            <h6>{{ $adminData->name }}</h6>
                        </div>
                        <div>
                            <h6>{{ $adminData->email }}</h6>
                        </div>
                        <div>
                            <h6>{{ $adminData->address }} / {{ $adminData->phone }}</h6>
                        </div>
                        <div>
                            <h6>{{ $adminData->tax_number }} / {{ $adminData->tax_administration }}</h6>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3 p-3" style="border: 1px solid black;">
                        <div>
                            <h6>{{ $offer->customers->name }}</h6>
                        </div>
                        <div>
                            <h6>{{ $offer->customers->email }}</h6>
                        </div>
                        <div>
                            <h6>{{ $offer->customers->address }} / {{ $offer->customers->phone }}</h6>
                        </div>
                        <div>
                            <h6>{{ $offer->customers->tax_number }} / {{ $offer->customers->tax_administration }}
                            </h6>
                        </div>
                    </div>




                </div>

                <div class="table-responsive-sm">
                    <table class="table table-bordered mb-0">
                        <h6 class="text-center"><b>TEKLİF DETAYLARI</b> </h6>
                        <thead>
                            <tr style="background-color: #eee;">
                                <th>S.NO</th>
                                <th>Malzeme Adı</th>
                                <th>Uzunluk</th>
                                <th>Adet</th>
                                <th>Birim</th>
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
                                    } elseif ($offerproduct->type == 4) {
                                        $totalAmount = $offerproduct->unit_price;
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
                                    <td>
                                        @if ($offerproduct->type == 4)
                                            -
                                        @else
                                            {{ $offerproduct->height }} mt
                                        @endif
                                    </td>
                                    <td>
                                        @if ($offerproduct->type == 4)
                                            -
                                        @else
                                            {{ $offerproduct->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($offerproduct->type == 1)
                                            Adetli
                                        @elseif ($offerproduct->type == 2)
                                            Ağırlıklı 
                                        @elseif ($offerproduct->type == 3)
                                            Metre
                                        @elseif ($offerproduct->type == 4)
                                            Diğer
                                        @endif
                                    </td>
                                    <td>{{ number_format($totalAmount, 2, ',', '.') }}TL
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="right"></td>
                                </tr>
                                <tr>
                                    <td class="right"><b>SATIŞ KOŞULLARI</b></td>
                                </tr>
                                <tr>

                                    <td class="right">{{ $offer->bid_option }}</td>
                                </tr>
                                <tr>
                                    <td class="right">{{ $offer->terms_of_payment }}</td>
                                </tr>
                                <tr>
                                    <td class="right">{{ $offer->delivery_date }}</td>
                                </tr>
                                <tr>
                                    <td class="right">{{ number_format($grandTotalWeight, 2, ',', '.') }} Toplam
                                        KG
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-danger">Ara Toplam</strong>
                                    </td>
                                    <td class="right">{{ number_format($grandTotalAmount, 2, ',', '.') }} TL</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-danger">Tevkifatlı Ara Toplam </strong>
                                    </td>
                                    <td class="right">
                                        {{ number_format($withholdinggrandTotalAmount, 2, ',', '.') }}
                                        TL</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-primary">Tevkifatsız Ara Toplam</strong>
                                    </td>
                                    <td class="right">{{ number_format($noholdinggrandTotalAmount, 2, ',', '.') }}
                                        TL
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-danger">Tevkifatlı KDV</strong>
                                    </td>
                                    <td class="right">
                                        {{ number_format($totalwithholdingkdv, 2, ',', '.') }} TL
                                    </td>
                                </tr>

                                <tr>
                                    <td class="left">
                                        <strong class="text-primary">KDV</strong>
                                    </td>
                                    <td class="right">
                                        {{ number_format($totalnoholdingkdv, 2, ',', '.') }} TL
                                    </td>
                                </tr>

                                <tr>
                                    <td class="left">
                                        <strong><b>TOPLAM FİYAT</b></strong>
                                    </td>
                                    <td class="right" style="font-size: 18px;">
                                        <strong>{{ number_format($lastgrandTotalAmount, 2, ',', '.') }} TL</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="table-responsive-sm" style="margin-top: 240px">

                    <div class="row">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr style="background-color: #eee;">
                                    <th class="text-center">
                                        <h6><b>FİRMA BİLGİLERİ</b></h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>


                        <table class="table table-bordered mb-0 col-md-6">
                            <tbody>

                                <tr>
                                    <td>
                                        <h6>{{ $offer->customers->name }}</h6>
                                    </td>
                                </tr>
                                <div class="col-md-4">
                                    <tr>
                                        <td>
                                            <h6>{{ $offer->customers->address }}</h6>
                                        </td>
                                    </tr>
                                </div>

                                <div class="col-md-4">
                                    <tr>
                                        <td>
                                            <h6>{{ $offer->customers->tax_administration }} /
                                                {{ $offer->customers->tax_number }}</h6>
                                        </td>
                                    </tr>
                                </div>

                                <div class="col-md-4">
                                    <tr>
                                        <td>
                                            <a
                                                href="mailto:{{ $offer->customers->email }}">{{ $offer->customers->email }}</a>
                                        </td>
                                    </tr>
                                </div>
                            </tbody>

                        </table>


                        <table class="table table-bordered mb-0 col-md-6">
                            <tbody>


                                @foreach ($useribans as $useriban)
                                    <tr>
                                        <td>
                                            {{ $useriban->bank_name }} : <b> {{ $useriban->iban }} </b>
                                        </td>
                                    </tr>
                                @endforeach






                            </tbody>

                        </table>

                    </div>


                </div>

                <div class="row mb-4">
                    <div class="col-sm-6 mt-3 p-3" style="border: 1px solid black; ">
                        <div style="padding-bottom: 80px">
                            <h6 class="text-center">SATICI KAŞE İMZA</h6>
                        </div>

                    </div>
                    <div class="col-sm-6 mt-3 p-3" style="border: 1px solid black;">
                        <div>
                            <h6 class="text-center">MÜŞTERİ KAŞE İMZA</h6>
                        </div>

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
