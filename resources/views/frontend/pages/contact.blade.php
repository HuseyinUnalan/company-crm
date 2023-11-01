@extends('frontend.main_master')
@section('content')

@section('site_title')
    İletişim
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
            <h1 class="title">İletişim</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('/') }}">Anasayfa</a></li>
                <li>İletişim</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!--Contact Details Start-->
<section class="contact-details">
    <div class="container ">
        <div class="row">
            <div class="col-xl-7 col-lg-6">
                <div class="sec-title">
                    <span class="sub-title">Bize Yazın</span>
                    <h2>Bize Mesaj Gönder</h2>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Contact Form -->
                <form action="{{ route('store.message') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="name" class="form-control" type="text" placeholder="Ad Soyad"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="email" class="form-control required email" type="email"
                                    placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="subject" class="form-control required" type="text" placeholder="Konu"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="phone" class="form-control" type="text" placeholder="Telefon Numarası"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control required" rows="7" placeholder="Mesajınız" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">
                                Mesaj Gönder
                            </span></button>
                    </div>
                </form>
                <!-- Contact Form Validation-->
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="contact-details__right">
                    <div class="sec-title">
                        <span class="sub-title">Bize Ulaşın</span>
                        <h2>İletişime Geç</h2>

                    </div>
                    <ul class="list-unstyled contact-details__info">
                        <li>
                            <div class="icon">
                                <span class="lnr-icon-phone-plus"></span>
                            </div>
                            <div class="text">
                                <h6>Telefon Numarası</h6>
                                <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="lnr-icon-envelope1"></span>
                            </div>
                            <div class="text">
                                <h6>Email</h6>
                                <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="lnr-icon-location"></span>
                            </div>
                            <div class="text">
                                <h6>Adres</h6>
                                <span>{{ $settings->address }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Details End-->

<!-- Divider: Google Map -->
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Google Map HTML Codes -->
            <iframe src="{{ $settings->map }}" data-tm-width="100%" height="500" frameborder="0"
                allowfullscreen=""></iframe>
        </div>
    </div>
</section>
@endsection
