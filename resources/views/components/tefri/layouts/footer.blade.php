    <!-- Start Subscribe Area -->
    <div class="section subscribe-area">
        <div class="container">
            <div class="subscribe-bg bg-color-3270ff wow fadeInUp delay-0-2s">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="subscribe-content">
                            <h2>Subscribe to the updates!</h2>
                            <p>Sign up to our newsletter and be the first to know about the latest news, special offers,
                                events, and discounts.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="newsletter-wrap">
                            <form class="newsletter-form" data-toggle="validator">
                                <input type="email" class="form-control" placeholder="Your email address"
                                    name="EMAIL" required autocomplete="off">

                                <button class="default-btn" type="submit">
                                    Subscribe
                                </button>

                                <div id="validator-newsletter" class="form-result"></div>
                            </form>
                        </div>
                    </div>
                </div>

                <img src="{{ asset('storage/themes/tefri') }}/images/subscribe-shape.png" class="subscribe-shape" alt="Image">
            </div>
        </div>
    </div>
    <!-- End Subscribe Area -->

    <!-- Start Footer Area -->
    <div class="footer-area bg-color-ffffff pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-footer-widget wow fadeInUp delay-0-2s">
                        <a href="{{ route('home') }}">
                            <img src="storage/common/images/logo/logo.jpg" width="120px" class="main-logo"
                                alt="Image">
                            <img src="storage/common/images/logo/logo.jpg" width="120px" class="white-logo"
                                alt="Image">
                        </a>

                        <p>Now getting vet doctor on your phone at very low cost with getvet.</p>

                        <ul class="social-link">
                            <li>
                                <a href="https://facebook.com/" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://linkedin.com/" target="_blank">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/" target="_blank">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="single-footer-widget wow fadeInUp delay-0-4s">
                        <h3>Contacts Info</h3>

                        <ul class="contact-info">
                            <li>
                                <span>Address:</span>
                                {{ $settings->address }}
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:{{ $settings->address }}">{{ $settings->address }}</a>
                            </li>
                            <li>
                                <span>Email:</span>
                                <a
                                    href="mailto:{{ $settings->email }}">
									{{ $settings->email }}
								 </a>
                            </li>
                            <li>
                                <span>Time:</span>
                                24 X 7
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="single-footer-widget wow fadeInUp delay-0-6s">
                        <h3>Quick Link</h3>

                        <ul class="help-link">
                            <li>
                                <a href="about.html">About Us</a>
                            </li>
                            <li>
                                <a href="solution.html">Solutions</a>
                            </li>
                            <li>
                                <a href="contact-us.html">Contact Us</a>
                            </li>
                            <li>
                                <a href="privacy-policy.html">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="terms-conditions.html">Terms of Use</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 d-none">
                    <div class="single-footer-widget wow fadeInUp delay-0-8s">
                        <h3>Apps Download</h3>
                        <p>Download today and get your free copy from Apple and Play Store</p>

                        <div class="app-btn">
                            <a href="https://play.google.com/store/apps" class="default-btn" target="_blank">
                                <span>
                                    <i class="ri-google-play-fill"></i>
                                    Play Store
                                </span>
                            </a>
                            <a href="https://www.apple.com/store" class="default-btn apple" target="_blank">
                                <span>
                                    <i class="ri-apple-fill"></i>
                                    App Store
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area -->

    <!-- Start Copyright Area -->
    <div class="copy-right-area bg-color-ffffff">
        <div class="container">
            <div class="copy-right-bg">
                <div class="row align-items-center wow fadeInLeft delay-0-2s">
                    <div class="col-lg-6">
                        <p>Copyright @<span id="year"></span> Tefri. All Rights Reserved by <a
                                href="https://getvet.in/" target="_blank">GetVet</a></p>
                    </div>
                    <div class="col-lg-6">
                        <div class="language wow fadeInRight delay-0-2s">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Language</option>
                                <option value="1">English</option>
                                <option value="2">Arabic</option>
                                <option value="3">Germany</option>
                            </select>
                            <i class="ri-global-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area -->

    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-s-fill"></i>
        <i class="ri-arrow-up-s-fill"></i>
    </div>
    <!-- End Go Top Area -->