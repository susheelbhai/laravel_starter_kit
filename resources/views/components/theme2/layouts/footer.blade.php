@php
    $settings = Config::get('settings');
    $important_links = \App\Models\ImportantLink::all();
@endphp

<style>
  .newsnewsletter_lable{
    display: block;
    font: 1em sans-serif;
  }
  #newsnewsletter{
    display: block;
  }
</style>
<footer class="footer-area footer-2 pt-120 pb-120">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-widget-area"><a class="d-block mb-4"
                        href="{{ route('home') }}"><img
                            src="{{ asset('storage/images/webpages/logo/' . $settings->light_logo) }}" width="150" alt=""></a>
                    <p>{{ Config::get('settings', 'default')->short_description }}</p>
                    <!-- Newsletter Form -->
                    <div class="newsletter-form mb-4">
                      <label for="newsnewsletter" class="newsnewsletter_lable"> Get Updated</label>
                        <form class="d-flex align-items-stretch" action="#">
                          
                            <input id="newsletter" class="form-control rounded-0 rounded-start" type="email"
                                placeholder="Enter email">
                            <button class="btn btn-warning rounded-0 rounded-end px-3" type="submit"><i
                                    class="bi bi-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-widget-area">
                    <h5 class="mb-4 text-white">Our Products</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"><i
                                    class="bi bi-caret-right"></i>Suha Mobile</a></li>
                        <li><a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"><i
                                    class="bi bi-caret-right"></i>Affan Mobile</a></li>
                        <li><a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"><i
                                    class="bi bi-caret-right"></i>Newsten Blog</a></li>
                        <li><a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"><i
                                    class="bi bi-caret-right"></i>Classy Multipurpose</a></li>
                        <li><a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"><i
                                    class="bi bi-caret-right"></i>Educamp Education</a></li>
                    </ul>
                </div>
            </div>
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-widget-area">
                    <h5 class="mb-4 text-white">Important Links</h5>
                    <ul class="list-unstyled">
                        @foreach ($important_links as $i)
                            <li><a href="{{ $i->href }}" target="_blank"><i
                                        class="bi bi-caret-right"></i>{{ $i->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="footer-widget-area">
                    <h5 class="mb-4 text-white">Our Location</h5>
                    <p class="lh-base mb-3">
                    <address> {{ Config::get('settings', 'default')->address }} </address>
                    </p>
                    <p class="mb-0">Call: {{ Config::get('settings', 'default')->phone }} <br> Email:
                        {{ Config::get('settings', 'default')->email }}</p>
                    <!-- Footer Social Icon -->
                    <div class="footer-social-icon d-flex align-items-center mt-3">
                        <a href="{{ Config::get('settings', 'default')->facebook }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Facbook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="{{ Config::get('settings', 'default')->twitter }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="{{ Config::get('settings', 'default')->instagram }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="{{ Config::get('settings', 'default')->linkedin }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Linkedin">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="{{ Config::get('settings', 'default')->youtube }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Youtube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copywrite-wrapper mt-5 rounded d-lg-flex align-items-lg-center justify-content-lg-between">
            <!-- Copywrite Text -->
            <div class="copywrite-text text-center text-lg-start mb-3 mb-lg-0 me-lg-4">
                <p class="mb-0">2021 &copy; All rights reserved by
                    <a href="{{ asset('storage/themes/theme2') }}/#"
                        target="_blank">{{ Config::get('settings', 'default')->app_name }}</a>
                </p>
            </div>
            <!-- Footer Nav -->

            <!-- Dropup -->
            <div class="copywrite-text text-center text-lg-end">

                <p class="mb-0">Design and developed by
                    <a href="https://digilight.in" target="_blank"> DigiLight</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll To Top -->
<div id="scrollTopButton"><i class="bi bi-arrow-up-short"></i></div>
<!-- Cookie Alert Area-->
<div class="cookiealert">
    <p>This site uses cookies. We use cookies to ensure you get the best experience on our website. For details, please
        check our <a href="{{ asset('storage/themes/theme2') }}/#" target="_blank"> Privacy Policy.</a></p>
    <button class="btn btn-primary btn-sm acceptcookies" type="button" aria-label="Close">I agree &amp; Close</button>
</div>
