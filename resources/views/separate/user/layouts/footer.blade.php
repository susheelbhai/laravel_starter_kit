<footer class="footer-area">
    <img src="{{ asset('themes/guest') }}/assets/imgs/bg-shape-4.svg" alt="Shape"
        class="animation-slide-right bg-shape" />
    <div class="footer-top">
        <div class="custom-container">
            <div class="custom-row align-items-end justify-content-between">
                <div class="left-content">
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('images/logo/'.config('app.dark_logo', 'dummy.png')) }}" alt="Logo" width="180px" />
                    </a>
                    <p>We provide the expertise and support to <br>
                        propel your business forward.</p>
                    <form action="#" method="POST" class="subscribe-form">
                        <div class="subscribe-box d-flex">
                            <input type="email" id="email" name="email" placeholder="Enter Your Email" />
                            <button id="submit2" class="theme-btn">Get Started</button>
                        </div>
                        <!-- Alert Message -->
                        <div class="input-row">
                            <div class="input-group alert-notification">
                                <div id="alert-message-subscribe" class="alert-msg"></div>
                            </div>
                        </div>
                    </form>
                    <div class="footer-clients d-flex align-items-center">
                        <div class="footer-client-img">
                            <img src="{{ asset('themes/guest') }}/assets/imgs/youtube.svg" alt="Youtube" />
                        </div>
                        <div class="footer-client-img">
                            <img src="{{ asset('themes/guest') }}/assets/imgs/webflow.svg" alt="webflow" />
                        </div>
                        <div class="footer-client-img">
                            <img src="{{ asset('themes/guest') }}/assets/imgs/upwork.svg" alt="upwork" />
                        </div>
                        <div class="footer-client-img">
                            <img src="{{ asset('themes/guest') }}/assets/imgs/shopify.svg" alt="shopify" />
                        </div>
                    </div>
                </div>

                <div class="right-content">
                    <div class="right-content-inner">
                        <h2>Let’s get started on something great</h2>
                        <p>Our team of IT experts looks forward to meeting with you <br>
                            and providing valuable insights tailored to your business.</p>
                        <a href="#contact" class="theme-btn">Get an appointment now</a>

                        <div class="footer-experience d-flex align-items-center">

                            <div class="footer-experience-item">
                                <h1>2 <span>Mins</span></h1>
                                <p>Response Time</p>
                            </div>
                            <div class="footer-experience-item">
                                <h1>99%</h1>
                                <p>Client Satisfaction</p>
                            </div>
                            <div class="footer-experience-item">
                                <h1>22+ <span>Years</span></h1>
                                <p>Field Experience</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="copyright-area">
        <div class="custom-container">
            <div class="custom-row d-flex align-items-center justify-content-between">
                <ul class="social-links d-flex align-items-center">
                    <li>
                        <a href="https://www.facebook.com/digamite" target="_blank">
                            <i class="iconoir-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/digamitepvtltd" target="_blank">
                            <i class="iconoir-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/digamitepvtltd/" target="_blank">
                            <i class="iconoir-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/company/digamite" target="_blank">
                            <i class="iconoir-linkedin"></i>
                        </a>
                    </li>
                </ul>

                <p>&copy; {{ date('Y') }} All rights reserved by <a href="{{ route('home') }}"> Digamite </a></p>
            </div>
        </div>
    </div>
</footer>
