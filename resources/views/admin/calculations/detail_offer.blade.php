@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">




            <div class="row">

                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $offer->customers->name }} Teklif Sayfası</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Malzeme Adı</th>
                                            <th>Boy</th>
                                            <th>Adet</th>
                                            <th>Toplam KG </th>
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
                                                    @if ($offerproduct->type == 4)
                                                        -
                                                    @else
                                                        {{ number_format($totalWeight, 2, ',', '.') }}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($totalAmount, 2, ',', '.') }} TL
                                                </td>
                                            </tr>
                                        @endforeach

                                        <!-- Toplam fiyatlar ve kilolar için tfoot -->
                                    <tfoot>
                                        <tr>
                                            {{-- <td>{{ number_format($grandTotalWeight, 2, ',', '.') }}</td> --}}
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-danger">Ara Toplam</td>
                                            <td>{{ number_format($grandTotalAmount, 2, ',', '.') }} TL</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $offer->bid_option }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-danger">Tevkifatlı Ara Toplam</td>
                                            <td>{{ number_format($withholdinggrandTotalAmount, 2, ',', '.') }} TL</td>
                                        </tr>

                                        <tr>
                                            <td>{{ $offer->terms_of_payment }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-primary">Tevkifatsız Ara Toplam</td>
                                            <td>{{ number_format($noholdinggrandTotalAmount, 2, ',', '.') }} TL</td>
                                        </tr>

                                        <tr>
                                            <td>{{ $offer->delivery_date }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-danger">Tevkifatlı KDV</td>
                                            <td>{{ number_format($totalwithholdingkdv, 2, ',', '.') }} TL</td>
                                        </tr>

                                        <tr>
                                            <td>{{ number_format($grandTotalWeight, 2, ',', '.') }} Toplam KG</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-primary">KDV</td>
                                            <td>{{ number_format($totalnoholdingkdv, 2, ',', '.') }} TL</td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>TOPLAM FİYAT</b></td>
                                            <td style="font-size: 18px;">
                                                <b>{{ number_format($lastgrandTotalAmount, 2, ',', '.') }} TL</b>
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-2">
                    <a href="{{ route('print.invoice', $offer->id) }}" target="_blank" class="btn btn-success">Fatura
                        Yazdır</a>

                </div>

            </div>
            <!-- end row -->





        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
