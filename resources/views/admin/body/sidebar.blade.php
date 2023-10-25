<div class="vertical-menu">
    <div data-simplebar class="h-100">



        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('/') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>




                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-honour-line"></i>
                        <span>Ürün İşlemleri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.products') }}">Ürün Listesi</a></li>
                        <li><a href="{{ route('add.product') }}">Ürün Ekle</a></li>
                    </ul>
                </li>


                {{-- @if (auth()->check() && auth()->user()->statu == 1) --}}
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
                {{-- @else
                @endif --}}


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-honour-line"></i>
                        <span>Teklif İşlemleri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('calculate') }}">Teklif Hazırla</a></li>
                        <li><a href="{{ route('my.offers') }}">Tekliflerim</a></li>

                        
                    </ul>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
