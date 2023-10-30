@extends('frontend.main_master')
@section('content')

@section('site_title')
    {{ $settings->site_title }}
@endsection

@section('meta_keywords')
    {!! $blog->description !!}
@endsection

@section('meta_description')
    {!! $blog->description !!}
@endsection

<!-- Start main-content -->
<section class="page-title"
    style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">{{ $blog->title }}</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('/') }}">Anasayfa</a></li>
                <li>{{ $blog->title }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<!--Blog Details Start-->
<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-details__left">
                    <div class="blog-details__img">
                        <img src="{{ asset($blog->photo) }}" alt="">
                    </div>
                    <div class="blog-details__content">

                        <h3 class="blog-details__title">{{ $blog->title }}</h3>
                        <p class="blog-details__text-2">
                            {!! $blog->description !!}
                        </p>

                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">

                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Bloglarımız</h3>
                        <ul class="sidebar__post-list list-unstyled">
                            @foreach ($blogs as $blog)
                                <li>
                                    <div class="sidebar__post-image"> <img src="{{ asset($blog->photo) }}"
                                            alt="">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <h3>
                                            <a href="{{ route('blog.details', $blog->title_slug) }}">
                                                {{ $blog->title }}
                                            </a>
                                        </h3>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Blog Details End-->
@endsection
