<footer class="main-footer">
    <div class="bg-image" style="background-image: url({{ asset('frontend/assets/images/background/2.jpg') }})"></div>

    <!--Widgets Section-->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <!--Footer Column-->
                <div class="footer-column col-xl-6 col-lg-12 col-md-6 col-sm-12">
                    <div class="footer-widget about-widget">
                        <div class="logo col-md-6"><a href="{{ route('/') }}"><img src="{{ asset($settings->logo) }}"
                                    alt=""></a>
                        </div>
                        <div class="text">
                            {!! Str::limit(filter_var($about->description, FILTER_SANITIZE_STRING), 200) !!}
                        </div>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget">
                        <h3 class="widget-title">Bloglar</h3>
                        <ul class="user-links">
                            @foreach ($blogs as $blog)
                                <li><a href="{{ route('blog.details', $blog->title_slug) }}">{{ $blog->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget contact-widget">
                        <h3 class="widget-title">İletişim</h3>
                        <div class="widget-content">
                            <div class="text">{{ $settings->address }}</div>
                            <ul class="contact-info">
                                <li><i class="fa fa-envelope"></i> <a
                                        href="mailto:{{ $settings->email }}">{{ $settings->email }}</a><br></li>
                                <li><i class="fa fa-phone-square"></i> <a href="tel:{{ $settings->phone }}">
                                        {{ $settings->phone }}
                                    </a><br></li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">&copy; Tüm Hakları Saklıdır 2023 .
                </div>


            </div>
        </div>
    </div>
</footer>
