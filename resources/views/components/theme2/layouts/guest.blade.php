<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:13:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Saasbox - Multipurpose HTML Template for Saas &amp; Agency">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Title-->
    <title> {{ Config::get('settings', 'default')->app_name; }} Authentication </title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/core-img/favicon.ico" type="image/x-icon">
    <!-- All CSS Stylesheet-->
    <link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/css/all-css-libraries.css">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" href="{{ asset('storage/themes/theme2') }}/style.css">
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-light" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Header Area-->
    @include('user.layouts.header')

    <!-- Breadcrumb -->
    <div class="breadcrumb-wrapper bg-img bg-overlay" style="background-image: url('img/bg-img/12.jpg');">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-12">
            <div class="breadcrumb-content">
              <h2 class="breadcrumb-title">Login</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="#">Login</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-120 d-block"></div>
    <!-- Register -->
    <div class="register-area">
      <div class="container">
        <div class="row g-4 g-lg-5 align-items-center justify-content-between">
          <!-- Thumbnail -->
          <div class="col-12 col-lg-6">
            <div class="register-thumbnail"><img src="{{ asset('storage/themes/theme2') }}/img/illustrator/hero-3.png" alt=""></div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card register-card bg-gray p-2 p-sm-4">
              <div class="card-body">
                <h4>Welcome Back!</h4>
                <p>Didn't have an account?<a class="ms-2" href="{{ route('register') }}">Sign Up</a></p>
                <!-- Register Form -->
                {{ $slot }}

                
                <!-- Sign in via others -->
                <div class="signin-via-others d-none">
                  <p class="mb-0">Or Sign in with</p><a class="btn btn-primary btn-sm mt-3 me-3" href="#"><i class="bi bi-facebook me-2"></i>Facebook</a><a class="btn btn-primary btn-sm mt-3 me-3" href="#"><i class="bi bi-twitter me-2"></i>Twitter</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-120 d-block"></div>
    <!-- Footer Area-->
    <footer class="footer-area footer-2 pt-120 pb-120">
      <div class="container">
        <div class="row g-4 g-lg-5">
          <!-- Footer Widget Area -->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="footer-widget-area"><a class="d-block mb-4" href="index.html"><img src="{{ asset('storage/themes/theme2') }}/img/core-img/logo-white.png" alt=""></a>
              <p>It's crafted with the latest trend of design &amp; coded with all modern approaches.</p>
              <!-- Newsletter Form -->
              <div class="newsletter-form mb-4">
                <form class="d-flex align-items-stretch" action="#">
                  <input class="form-control rounded-0 rounded-start" type="email" placeholder="Enter email">
                  <button class="btn btn-warning rounded-0 rounded-end px-3" type="submit"><i class="bi bi-arrow-right"></i></button>
                </form>
              </div>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="footer-widget-area">
              <h5 class="mb-4 text-white">Our Products</h5>
              <ul class="list-unstyled">
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Suha Mobile</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Affan Mobile</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Newsten Blog</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Classy Multipurpose</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Educamp Education</a></li>
              </ul>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="footer-widget-area">
              <h5 class="mb-4 text-white">Important Links</h5>
              <ul class="list-unstyled">
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Community &amp; Forum</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>About Licences</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Careers</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Terms &amp; Conditions</a></li>
                <li><a href="#" target="_blank"><i class="bi bi-caret-right"></i>Privacy Policy</a></li>
              </ul>
            </div>
          </div>
          <!-- Footer Widget Area -->
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="footer-widget-area">
              <h5 class="mb-4 text-white">Our Location</h5>
              <p class="lh-base mb-3">Designing World Inc. <br> 1604 NSD, Dhaka, BD</p>
              <p class="mb-0">Call: +123 456 789 <br> Email: help@example.com</p>
              <!-- Footer Social Icon -->
              <div class="footer-social-icon d-flex align-items-center mt-3"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Facbook"><i class="bi bi-facebook"></i></a><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="bi bi-twitter"></i></a><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="bi bi-instagram"></i></a><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="bi bi-linkedin"></i></a><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Youtube"><i class="bi bi-youtube"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copywrite-wrapper mt-5 rounded d-lg-flex align-items-lg-center justify-content-lg-between">
          <!-- Copywrite Text -->
          <div class="copywrite-text text-center text-lg-start mb-3 mb-lg-0 me-lg-4">
            <p class="mb-0">2021 &copy; All rights reserved by <a href="#" target="_blank">Designing World</a></p>
          </div>
          <!-- Footer Nav -->
          <div class="footer-nav mb-3 mb-lg-0 me-lg-4">
            <ul class="mb-0 d-flex flex-wrap justify-content-center list-unstyled">
              <li><a href="#" target="_blank">Privacy Policy</a></li>
              <li><a href="#" target="_blank">Terms &amp; Conditions</a></li>
              <li><a href="#" target="_blank">Get Support</a></li>
            </ul>
          </div>
          <!-- Dropup -->
          <div class="language-dropdown text-center text-lg-end">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Language</button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><span class="me-2 flag-icon flag-icon-sa"></span>Arabic</a><a class="dropdown-item" href="#"><span class="me-2 flag-icon flag-icon-bd"></span>Bengali</a><a class="dropdown-item" href="#"><span class="me-2 flag-icon flag-icon-us"></span>English</a><a class="dropdown-item" href="#"><span class="me-2 flag-icon flag-icon-my"></span>Malay</a><a class="dropdown-item" href="#"><span class="me-2 flag-icon flag-icon-es"></span>Spanish</a></div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Scroll To Top -->
    <div id="scrollTopButton"><i class="bi bi-arrow-up-short"></i></div>
    <!-- All JavaScript Files-->
    <script src="{{ asset('storage/themes/theme2') }}/js/all-js-libraries.js"></script>
    <script src="{{ asset('storage/themes/theme2') }}/js/active.js"></script>
  </body>

<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:13:36 GMT -->
</html>


