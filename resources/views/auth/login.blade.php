@extends('frontend.main_master')
@section('content')
    <!-- Start main-content -->
    <section class="page-title"
        style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Giriş Yap</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('/') }}">Anasayfa</a></li>
                    <li>Giriş Yap</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
    <!--checkout Start-->
    <section>
        <div class="container pt-70">
            <div class="section-content">
                <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-3">
                    @csrf
                    <div class="row mt-30">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="billing-details">
                                <h3 class="mb-30">Giriş Yap</h3>
                                <div class="row">

                                    <div class="mb-3 col-md-12">
                                        <label for="checkuot-form-fname">E-mail</label>
                                        <input id="checkuot-form-fname" id="email" type="email" name="email"
                                            :value="old('email')" required autofocus placeholder="E-mail"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="checkuot-form-lname">Şifre</label>
                                        <input class="form-control" id="password" type="password" name="password" required
                                            autocomplete="current-password" placeholder="Şifre">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">
                                                Giriş Yap
                                            </span></button>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('register') }}">Hesabınız Yok mu? Hesap Oluştur</a>
                        </div>
                        <div class="col-md-2"></div>



                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--checkout Start-->
@endsection
