<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset($settings->logo) }}" alt="logo-sm" width="160" height="auto">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset($settings->logo) }}" alt="logo-dark" width="160" height="auto">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset($settings->logo) }}" alt="logo-sm-light" width="160" height="auto">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset($settings->logo) }}" alt="logo-light" width="160" height="auto">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>




        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">


                </div>
            </div>





            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>


            @php

                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/no_image.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('edit.profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> Profil Düzenle</a>
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i
                            class="ri-wallet-2-line align-middle me-1"></i>
                        Şifre Değiş</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıkış</a>
                </div>
            </div>



        </div>
    </div>
</header>
