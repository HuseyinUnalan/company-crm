@extends('frontend.main_master')
@section('content')
    <!-- Start main-content -->
    <section class="page-title"
        style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Kayıt Ol</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('/') }}">Anasayfa</a></li>
                    <li>Kayıt Ol</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
    <!--checkout Start-->
    <section>
        <div class="container pt-70">
            <div class="section-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mt-30">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="billing-details">
                                <h3 class="mb-30">Kayıt Ol</h3>
                                <div class="row">

                                    <div class="mb-3 col-md-12">
                                        <label for="checkuot-form-fname">Firma Adı</label>
                                        <input class="form-control" id="name" type="text" name="name"
                                            :value="old('name')" required autofocus placeholder="Firma Adı">
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="checkuot-form-fname">E-mail</label>
                                        <input class="form-control" id="email" type="email" name="email"
                                            :value="old('email')" required autofocus placeholder="E-mail">
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="checkuot-form-fname">Şifre</label>
                                        <input class="form-control" id="password" type="password" name="password" required
                                            autocomplete="current-password" placeholder="Şifre">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="checkuot-form-fname">Şifre Tekrar</label>
                                        <input class="form-control" id="password_confirmation" type="password"
                                            name="password_confirmation" required autocomplete="current-password"
                                            placeholder="Şifre Tekrar">
                                    </div>



                                    <div class="mb-3">
                                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">
                                                Kayıt Ol
                                            </span></button>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('login') }}" class="text-muted">Hesabın Var mı? Giriş Yap</a>
                        </div>
                        <div class="col-md-2"></div>



                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--checkout Start-->
@endsection
