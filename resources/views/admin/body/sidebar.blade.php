<div class="vertical-menu">
    <div data-simplebar class="h-100">



        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-honour-line"></i>
                        <span>Müşteri İşlemleri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.customers') }}">Müşteri Listesi</a></li>
                        <li><a href="{{ route('add.customer') }}">Müşteri Ekle</a></li>
                    </ul>
                </li>


                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-honour-line"></i>
                        <span>IBAN İşlemleri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.user.iban') }}">IBAN Listesi</a></li>
                        <li><a href="{{ route('add.user.iban') }}">IBAN Ekle</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-honour-line"></i>
                        <span>Teklif İşlemleri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('calculate') }}">Teklif Hazırla</a></li> --}}
                        <li><a href="{{ route('my.offers') }}">Tekliflerim</a></li>


                    </ul>
                </li>

                <li>
                    <a href="{{ route('/') }}">
                        <i class="ri-honour-line"></i>
                        <span>Web Sitesi</span>
                    </a>
                </li>

                @if (auth()->check() && auth()->user()->statu == 1)
                    <li class="menu-title">Süper Admin</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-honour-line"></i>
                            <span>Ürün İşlemleri</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.products') }}">Ürün Listesi</a></li>
                            <li><a href="{{ route('add.product') }}">Ürün Ekle</a></li>

                            <li><a href="{{ route('all.product.categories') }}">Ürün Kategori Listesi</a></li>
                            <li><a href="{{ route('add.product.category') }}">Ürün Kategori Ekle</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('super.admin.all.offers') }}">
                            <i class="ri-honour-line"></i>
                            <span>Bütün Teklifler</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('super.admin.all.users') }}">
                            <i class="ri-honour-line"></i>
                            <span>Bütün Kullanıcılar</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('super.admin.all.products') }}">
                            <i class="ri-honour-line"></i>
                            <span>Bütün Ürünler</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('super.admin.all.customers') }}">
                            <i class="ri-honour-line"></i>
                            <span>Bütün Müşteriler</span>
                        </a>

                    </li>


                    <li class="menu-title">Süper Admin Web Site İçerik Yönetim</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="far fa-image"></i>
                            <span>Slider İşlemleri</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.slider') }}">Slider Listesi</a></li>
                            <li><a href="{{ route('add.slider') }}">Slider Ekle</a></li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-shield-user-line"></i>
                            <span>Hakkımızda İşlemleri</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('edit.about') }}">Hakkımızda Düzenle</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-settings-3-line"></i>
                            <span>Ayarlar</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('settings.edit') }}">Genel Ayarlar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-honour-line"></i>
                            <span>Blog İşlemleri</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.blog') }}">Blog Listesi</a></li>
                            <li><a href="{{ route('add.blog') }}">Blog Ekle</a></li>
                        </ul>
                    </li>
                @else
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
