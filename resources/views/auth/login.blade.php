<!doctype html>
<html lang="tr">

<head>

    <meta charset="utf-8" />
    <title> Giriş Yap </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Toastr Css-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>


<body style="background-image: url({{ asset('backend/assets/images/background.jpg') }}); width: auto; height: 600px;">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">



                    <h4 class="text-muted text-center font-size-18"><b>Giriş Yap </b></h4>

                    <div class="p-3">
                        <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-3">
                            @csrf

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="email" type="email" name="email"
                                        :value="old('email')" required autofocus placeholder="E-mail">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password" type="password" name="password" required
                                        autocomplete="current-password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="remember_me" name="remember" type="checkbox"
                                            class="custom-control-input">
                                        <label class="form-label ms-1" for="customCheck1">Beni Hatırla</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">
                                        Giriş Yap
                                    </button>
                                </div>
                            </div>

                           
                                <div class="col-sm-12 mt-3">
                                    <a href="{{ route('register') }}" class="text-muted">Hesabınız Yok mu? Hesap Oluştur</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end -->
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- Toastr js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
