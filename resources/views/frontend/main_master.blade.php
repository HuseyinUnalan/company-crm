@php
    $about = App\Models\About::find(1);
    $settings = App\Models\Settings::find(1);
    $blogs = App\Models\Blogs::where('status', 1) // status sütunu 1 olanları seç
        ->orderBy('desk', 'asc') // desk sütununa göre artan sıralama
        ->get();
@endphp
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>@yield('site_title')</title>
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">
    <!-- Stylesheets -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION SETTINGS STYLES -->
    <link href="{{ asset('frontend/assets/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION LAYERS STYLES -->
    <link href="{{ asset('frontend/assets/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION NAVIGATION STYLES -->

    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset($settings->favicon) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/x-icon">
    <link href="{{ asset('frontend/assets/css/new.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>

    <div class="page-wrapper">


        <!-- Main Header-->
        @include('frontend.body.header')
        <!--End Main Header -->

        @yield('content')

        <!-- Main Footer -->
        @include('frontend.body.footer')
        <!--End Main Footer -->

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <!--Revolution Slider-->
    <script src="{{ asset('frontend/assets/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}">
    </script>
    <script
        src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}">
    </script>
    <script src="{{ asset('frontend/assets/js/main-slider-script.js') }}"></script>
    <!--Revolution Slider-->
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Silmek İstediğine Emin misin?',
                    text: "Bunu geri döndüremezsiniz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, Sil!',
                    cancelButtonText: 'İptal Et!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Silindi!',
                            'Kayıt Başarıyla Silindi.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>

    @auth
        <!-- GetButton.io widget -->
        <script type="text/javascript">
            (function() {
                var options = {
                    whatsapp: "+(90){{ $settings->whatsapp }}", // WhatsApp number
                    call_to_action: "Bize mesaj gönderin", // Call to action
                    position: "left", // Position may be 'right' or 'left'
                };
                var proto = document.location.protocol,
                    host = "getbutton.io",
                    url = proto + "//static." + host;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url + '/widget-send-button/js/init.js';
                s.onload = function() {
                    WhWidgetSendButton.init(host, proto, options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            })
            ();
        </script>
        <!-- /GetButton.io widget -->
    @else
    @endauth



</body>

</html>
