<header class="main-header header-style-one">
    <!-- Header Top -->
    <div class="header-top">
        <div class="inner-container">

            <div class="top-left">
                <!-- Info List -->
                <ul class="list-style-one">
                    <li><i class="fa fa-envelope"></i> <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                    </li>
                    <li><i class="fa fa-phone"></i> <a href="tel:{{ $settings->phone }}"> {{ $settings->phone }} </a></li>
                </ul>
            </div>


        </div>

        {{-- <div class="outer-box">
            <ul class="social-icon-one">
                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
            </ul>
        </div> --}}
    </div>
    <!-- Header Top -->

    <!-- Header Lower -->
    <div class="header-lower">
        <!-- Main box -->
        <div class="main-box">
            <div class="logo-box">
                <div class="logo"><a href="{{ route('/') }}"><img src="{{ asset($settings->logo) }}"
                            style="width: 160px; height: auto;" alt="" title="Oitech"></a>
                </div>
            </div>

            <!--Nav Box-->
            <div class="nav-outer">

                <nav class="nav main-menu">
                    <ul class="navigation">
                        <li><a href="{{ route('/') }}">Anasayfa</a></li>
                        <li><a href="{{ route('home.about') }}">Hakkımızda</a></li>
                        <li><a href="{{ route('home.contact') }}">İletişim</a></li>
                        <li><a href="{{ route('home.blogs') }}">Blog</a></li>
                    </ul>
                </nav>
                <!-- Main Menu End-->


                <div class="outer-box">
                    @auth
                        <a href="{{ route('add.offer') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Teklif Hazırla
                            </span></a>
                        <a href="{{ route('dashboard') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Panelim
                            </span></a>
                        <a href="{{ route('admin.logout') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Çıkış Yap
                            </span></a>
                    @else
                        <a href="{{ route('login') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Giriş Yap
                            </span></a>
                        <a href="{{ route('register') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Kayıt Ol
                            </span></a>
                    @endauth


                    <!-- Mobile Nav toggler -->
                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Lower -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>

        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        <nav class="menu-box">
            <div class="upper-box">
                <div class="nav-logo"><a href="{{ route('/') }}"><img src="{{ asset($settings->logo) }}"
                            alt="" title=""></a>
                </div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>

            <ul class="navigation clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </ul>
            <ul class="contact-list-one">
                <li>
                    <!-- Contact Info Box -->
                    <div class="contact-info-box">
                        <i class="icon lnr-icon-phone-handset"></i>
                        <span class="title">Telefon Numarası</span>
                        <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
                    </div>
                </li>
                <li>
                    <!-- Contact Info Box -->
                    <div class="contact-info-box">
                        <span class="icon lnr-icon-envelope1"></span>
                        <span class="title">Email</span>
                        <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                    </div>
                </li>
            </ul>


            {{-- <ul class="social-links">
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul> --}}
        </nav>
    </div><!-- End Mobile Menu -->



    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="inner-container">
                <!--Logo-->
                <div class="logo">
                    <a href="index.html" title=""><img src="images/logo-2.png" alt="" title=""></a>
                </div>

                <!--Right Col-->
                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->

                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div><!-- End Sticky Menu -->
</header>
