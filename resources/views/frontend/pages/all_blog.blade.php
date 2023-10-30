@extends('frontend.main_master')
@section('content')

@section('site_title')
    Bloglar
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

<!-- News Section -->
<section class="news-section">
    <div class="auto-container">

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
