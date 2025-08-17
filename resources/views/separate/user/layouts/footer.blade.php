
<div class="rts-footer-area footer-one rts-section-gapTop bg-footer-one">
    <div class="container bg-shape-f1">
        <!-- footer call to action area -->
        <div class="row">
            <div class="col-12">
                <div class="rts-cta-wrapper">
                    <div class="background-cta">
                        <div class="row">
                            <!-- cta-left -->
                            <div class="col-lg-6">
                                <div class="cta-left-wrapepr">
                                    <p class="cta-disc">
                                        Latest Business Ideas
                                    </p>
                                    <h3 class="title animated fadeIn">Sign Up Newsletter</h3>
                                </div>
                            </div>
                            <!-- cta left end -->
                            <div class="col-lg-6">
                                <!-- cta right -->
                                <form class="cta-input-arae" method="post" action="{{ route('newsletter') }}">
                                    @csrf
                                    <input type="email" name="email" placeholder="Enter Email Address" required="">
                                    <button type="submit" class="rts-btn btn-primary">Subscribe Now</button>
                                </form>
                                <!-- cta right End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer call to action area End -->
        <!-- rts footer area -->
        <div class="row pt--120 pt_sm--80 pb--80 pb_sm--40">
            <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                <div class="footer-one-single-wized">
                    <div class="wized-title">
                        <h5 class="title">Quick Links</h5>
                        <img src="{{ asset('themes/guest') }}/images/footer/under-title.png" alt="finbiz_footer">
                    </div>
                    <div class="quick-link-inner">
                        <ul class="links">
                            <li><a href="#"><i class="far fa-arrow-right"></i> Forum Support</a></li>
                            <li><a href="#"><i class="far fa-arrow-right"></i> Help &amp; FAQ</a></li>
                            <li><a href="{{ route('contact') }}"><i class="far fa-arrow-right"></i> Contact Us</a></li>
                            <li><a href="#"><i class="far fa-arrow-right"></i> Pricing &amp; Plans</a></li>
                            <li><a href="#"><i class="far fa-arrow-right"></i> Cookie Policy</a></li>
                        </ul>
                        <ul class="links margin-left-70">
                            <li><a href="{{ route('about') }}"><i class="far fa-arrow-right"></i> About Us</a></li>
                            <li><a href="#"><i class="far fa-arrow-right"></i> My Account</a></li>
                            <li><a href="#"><i class="far fa-arrow-right"></i>Our Company</a></li>
                            <li><a href="{{ route('services') }}"><i class="far fa-arrow-right"></i>Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- footer mid area -->
            <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                <div class="footer-one-single-wized mid-bg">
                    <div class="wized-title">
                        <h5 class="title">Opening Hours</h5>
                        <img src="{{ asset('themes/guest') }}/images/footer/under-title.png" alt="finbiz_footer">
                    </div>
                    <div class="opening-time-inner">
                        <div class="single-opening">
                            <p class="day">Week Days</p>
                            <p class="time">09.00 - 24:00</p>
                        </div>
                        <div class="single-opening">
                            <p class="day">Saturday</p>
                            <p class="time">08:00 - 03.00</p>
                        </div>
                        <div class="single-opening mb--30 mb_sm--10">
                            <p class="day">Sunday</p>
                            <p class="time">Day Off</p>
                        </div>
                        <a href="#" class="rts-btn btn-primary contact-us">Contact Us</a>
                    </div>
                </div>
            </div>
            <!-- footer mid area end -->

            <!-- footer end area post -->
            <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                <div class="footer-one-single-wized margin-left-65">
                    <div class="wized-title">
                        <h5 class="title">Popular Updates</h5>
                        <img src="{{ asset('themes/guest') }}/images/footer/under-title.png" alt="finbiz_footer">
                    </div>
                    <div class="post-wrapper">
                        <!-- single post -->
                        <div class="single-footer-post mb--30">
                            <div class="left-thumbnail">
                                <img src="{{ asset('themes/guest') }}/images/footer/post/01.png" alt="finbiz_business-post">
                            </div>
                            <div class="post-right">
                                <p> <i class="fal fa-clock"></i> 15th April, 2022</p>
                                <a href="blog-details.html">
                                    <h6 class="title">Best Business Ideas For
                                        Getting Solution</h6>
                                </a>
                                <a class="red-more" href="blog-details.html">Read More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- single post End -->
                        <!-- single post -->
                        <div class="single-footer-post">
                            <div class="left-thumbnail">
                                <img src="{{ asset('themes/guest') }}/images/footer/post/02.png" alt="finbiz_business-post">
                            </div>
                            <div class="post-right">
                                <p> <i class="fal fa-clock"></i> 15th April, 2022</p>
                                <a href="blog-details.html">
                                    <h6 class="title">Best Business Ideas For
                                        Getting Solution</h6>
                                </a>
                                <a class="red-more" href="blog-details.html">Read More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- single post End -->
                    </div>
                </div>
            </div>
            <!-- footer end area post end-->
        </div>
        <!-- rts footer area End -->
    </div>
    <!-- copyright area start -->
    <div class="rts-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-left">
                        <p>{{ config('app.name') }} - Copyright {{ date('Y') }}. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <p>Design and developed by <a href="http://digamite.com" target="_blank" rel="noopener noreferrer">Digamite Private Limited</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright area end -->
</div>