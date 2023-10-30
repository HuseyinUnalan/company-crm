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


<section class="services-section-two mb-5">
    <div class="auto-container">
        <div class="row">
            <div class="title-column col-lg-5 col-md-12">
                <div class="sec-title light">
                    <span class="sub-title">Ne Yapıyoruz?</span>
                    <h2>Size İşinizde Kolaylık Sağlıyoruz</h2>
                    @auth
                        <a href="{{ route('add.offer') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Şimdi Başla
                            </span></a>
                    @else
                        <a href="{{ route('register') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Şimdi Başla
                            </span></a>
                    @endauth
                </div>
            </div>

            <div class="services-column col-lg-7 col-md-12">
                <div class="inner-column">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/LW-myQJceTE?si=PiVgUT8LTfxH1csD" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
