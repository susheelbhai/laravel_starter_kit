<header class="header--sticky header-one ">
    @include('user.layouts.top_header')
    
    <div class="header-main-one bg-white">
        <div class="container">
            <div class="row">
                {{ $header_logo }}
                <div class=" col-xl-9 col-lg-8 col-md-8 col-sm-8 col-8">
                    <div class="main-header">
                        <nav class="nav-main mainmenu-nav d-none d-xl-block">
                            <ul class="mainmenu">
                                {{ $header }}
                            </ul>
                        </nav>
                        <div class="button-area">
                            <a href="#" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btn">Get Quote</a>
                            <button id="menu-btn" class="menu rts-btn btn-primary-alta ml--20 ml_sm--5">
                                <img class="menu-dark" src="{{ asset('themes/guest') }}/images/icon/menu.png" alt="Menu-icon">
                                <img class="menu-light" src="{{ asset('themes/guest') }}/images/icon/menu-light.png" alt="Menu-icon">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<div id="side-bar" class="side-bar">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="rts-sidebar-menu-desktop">
        <a class="logo-1" href="{{ route('home') }}"><img class="logo" src="{{asset('images/logo/'.config('app.dark_logo', 'dummy.png'))}}" width="150px" alt="finbiz_logo"></a>
        <a class="logo-2" href="{{ route('home') }}"><img class="logo" src="{{asset('images/logo/'.config('app.dark_logo', 'dummy.png'))}}" width="150px" alt="finbiz_logo"></a>
        <a class="logo-3" href="{{ route('home') }}"><img class="logo" src="{{asset('images/logo/'.config('app.dark_logo', 'dummy.png'))}}" width="150px" alt="finbiz_logo"></a>
        <a class="logo-4" href="{{ route('home') }}"><img class="logo" src="{{asset('images/logo/'.config('app.dark_logo', 'dummy.png'))}}" width="150px" alt="finbiz_logo"></a>
        <div class="body d-none d-xl-block">
            <p class="disc">
                We must explain to you how all seds this mistakens idea denouncing pleasures and praising account.
            </p>
            <div class="get-in-touch">
                <!-- title -->
                <div class="h6 title">Get In Touch</div>
                <!-- title End -->
                <div class="wrapper">
                    <!-- single -->
                    <div class="single">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:{{ config('app.phone') }}">{{ config('app.phone') }}</a>
                    </div>
                    <!-- single ENd -->
                    <!-- single -->
                    <div class="single">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                    </div>
                    <!-- single ENd -->
                    <!-- single -->
                    <div class="single">
                        <i class="fas fa-globe"></i>
                        <a href="#">{{ env('APP_URL') }}</a>
                    </div>
                    <!-- single ENd -->
                    <!-- single -->
                    <div class="single">
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="#">
                            {{ config('app.address') }}
                        </a>
                    </div>
                    <!-- single ENd -->
                </div>
                <div class="social-wrapper-two menu">
                    <a href="{{ config('app.facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ config('app.twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="{{ config('app.instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{ config('app.whatsapp') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="{{ config('app.linkedin') }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="body-mobile d-block d-xl-none">
            <nav class="nav-main mainmenu-nav">
                <ul class="mainmenu">
                    {{ $header }}
                </ul>
            </nav>
            <div class="social-wrapper-two menu mobile-menu">
                <a href="{{ config('app.facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ config('app.twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="{{ config('app.instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="{{ config('app.whatsapp') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="{{ config('app.linkedin') }}" target="_blank"><i class="fab fa-linkedin"></i></a>
            </div>
            <a href="#" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu">Get Quote</a>
        </div>
    </div>
    <!-- inner menu area desktop End -->
</div>

<div class="search-input-area">
    <div class="container">
        <div class="search-input-inner">
            <div class="input-div">
                <input id="searchInput1" class="search-input" type="text" placeholder="Search by keyword or #">
                <button><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
    <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
</div>

<div id="anywhere-home">
</div>