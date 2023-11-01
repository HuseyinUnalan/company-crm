@extends('frontend.main_master')
@section('content')

@section('site_title')
    Tekliflerim
@endsection

@section('meta_keywords')
    {{ $settings->site_keywords }}
@endsection

@section('meta_description')
    {{ $settings->site_description }}
@endsection


<!-- Start main-content -->
<section class="page-title"
    style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Tekliflerim</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('/') }}">Anasayfa</a></li>
                <li>Tekliflerim</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!--cart Start-->
<section>
    <div class="container pb-100">
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered tbl-shopping-cart">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Teklif Hazırlanan Müşteri</th>
                                    <th>Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>


                                @php($i = 1)

                                @foreach ($offers as $item)
                                    <tr class="cart_item">
                                        <td>
                                            {{ $i++ }}
                                        </td>

                                        <td>{{ $item->customers->name }}

                                        </td>

                                        <td>
                                            {{ $item->date }}
                                        </td>

                                        <td>
                                            <a
                                                href="{{ route('detail.offer.front', ['id' => $item->id, 'user_id' => $item->user_id]) }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-file-invoice"></i>
                                                </button>
                                            </a>

                                            <a href="{{ route('delete.offer', $item->id) }}" id="delete">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section>
<!--cart Start-->

@endsection
