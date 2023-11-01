@extends('frontend.main_master')
@section('content')

@section('site_title')
    Hakkımızda
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
            <h1 class="title">Hakkımızda</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('/') }}">Anasayfa</a></li>
                <li>Hakkımızda</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!-- About Section Six-->
<section class="about-section-six">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight"
                data-wow-delay="600ms">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="sub-title">Biz Kimiz?</span>
                        <h2>{{ $about->title }}</h2>
                        <div class="text">
                            {!! $about->description !!}
                        </div>
                    </div>



                </div>
            </div>

            <!-- Image Column -->
            <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                <div class="inner-column wow fadeInLeft">
                    <figure class="image wow fadeIn"><img src="{{ asset($about->photo) }}" alt=""></figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Emd About Section Six-->



@endsection
