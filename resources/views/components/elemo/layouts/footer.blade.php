@php
    $settings = Config::get('settings');
    $important_links = \App\Models\ImportantLink::whereIsActive(1)->get();
@endphp




<footer id="footer" class="footer_2 secondary-bg">
    <div class="container">
        <div class="footer_widgets">
            <h5>Our Newsletter</h5>
            <div class="newsletter_wrap">
                <form method="get">
                    <input type="email" class="form-control" placeholder="Enter Email Address">
                    <input type="submit" value="subscribe" class="btn">
                </form>
            </div>
        </div>

        <div class="footer_widgets">
            <div class="footer_nav">
                <ul>
                    <li><a href="how-it-work.html">How it Work</a></li>
                    <li><a href="pricing.html">Pricing</a></li>
                    <li><a href="blog-grid-style.html">Blog</a></li>
                    <li><a href="contact-us.html">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & condition</a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <p>Copyright &copy; 2023 Elemo. All Rights Reserved</p>
                </div>

                <div class="col-md-6">
                    <div class="follow_us">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>

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
