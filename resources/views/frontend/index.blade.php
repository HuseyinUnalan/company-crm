@extends('frontend.main_master')
@section('content')

@section('site_title')
    {{ $settings->site_title }}
@endsection

@section('meta_keywords')
    {{ $settings->site_keywords }}
@endsection

@section('meta_description')
    {{ $settings->site_description }}
@endsection
<!--Main Slider-->
<section class="main-slider">
    <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
        <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
            <ul>

                @foreach ($sliders as $slider)
                    <!-- Slide 1 -->
                    <li data-index="rs-1" data-transition="zoomout">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset($slider->photo) }}" alt="" class="rev-slidebg">

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 hidden-mobile"
                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                            data-paddingtop="[0,0,0,0]" data-responsive_offset="on" data-type="shape" data-height="none"
                            data-whitespace="nowrap" data-width="none" data-hoffset="['-270','-190','-60','-190']"
                            data-voffset="['160','160','180','160']" data-x="['center','center','center','center']"
                            data-y="['middle','middle','middle','middle']"
                            data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('frontend/assets/images/main-slider/arrow.png') }}"
                                    alt="">
                            </figure>
                        </div>


                        <div class="tp-caption" data-paddingbottom="[0,0,0,0]" data-paddingleft="[15,15,15,15]"
                            data-paddingright="[15,15,15,15]" data-paddingtop="[0,0,0,0]" data-responsive_offset="on"
                            data-type="text" data-height="none" data-width="['750','750','750','650']"
                            data-whitespace="normal" data-hoffset="['0','0','0','0']"
                            data-voffset="['-50','-50','-50','-80']" data-x="['left','left','left','left']"
                            data-y="['middle','middle','middle','middle']" data-textalign="['top','top','top','top']"
                            data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h1> {{ $slider->title }}</h1>
                        </div>


                        <div class="tp-caption" data-paddingbottom="[0,0,0,0]" data-paddingleft="[15,15,15,15]"
                            data-paddingright="[15,15,15,15]" data-paddingtop="[0,0,0,0]" data-responsive_offset="on"
                            data-type="text" data-height="none" data-width="['700','750','700','450']"
                            data-whitespace="normal" data-hoffset="['0','0','0','0']"
                            data-voffset="['185','185','200','185']" data-x="['left','left','left','left']"
                            data-y="['middle','middle','middle','middle']" data-textalign="['top','top','top','top']"
                            data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
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
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</section>
<!-- End Main Slider-->

<!-- About Section -->
<section class="about-section pt-0 mt-5">


    <div class="auto-container">
        <div class="row">
            <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight"
                data-wow-delay="600ms">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="sub-title">Hakkımızda</span>
                        <h2>{{ $about->title }}</h2>
                        <div class="text">
                            {!! Str::limit(filter_var($about->description, FILTER_SANITIZE_STRING), 425) !!}

                        </div>
                    </div>
                    <div class="btm-box">
                        <a href="{{ route('home.about') }}" class="theme-btn btn-style-one"><span class="btn-title">
                                Devamını Oku</span></a>
                    </div>
                </div>
            </div>

            <!-- Image Column -->
            <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                <img src="{{ asset($about->photo) }}" alt="" class="img-fluid">

            </div>
        </div>
    </div>
</section>
<!--Emd About Section -->


<section class="services-section-two">
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
                        src="https://www.youtube.com/embed/LW-myQJceTE?si=PiVgUT8LTfxH1csD"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- News Section -->
<section class="news-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <span class="sub-title">Bloglarımız</span>
            <h2>Blog</h2>
        </div>

        <div class="row">

            @foreach ($blogs as $blog)
                <!-- News Block -->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="{{ route('blog.details', $blog->title_slug) }}"><img
                                        src="{{ asset($blog->photo) }}" alt=""></a></figure>
                        </div>
                        <div class="content-box">

                            <h4 class="title"><a href="{{ route('blog.details', $blog->title_slug) }}">
                                    {{ $blog->title }}
                                </a></h4>
                        </div>
                        <div class="bottom-box">
                            <a href="{{ route('blog.details', $blog->title_slug) }}" class="read-more">
                                Devamını Oku
                                <i class="fa fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
<!--End News Section -->
@endsection
