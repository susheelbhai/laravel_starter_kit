<x-user.app-layout>

    <x-slot name="head">
        <meta name="description" content="html 5 template">
        <meta name="author" content="">
        <title>{{ Config::get('settings', 'default')->app_name; }}</title>
    </x-slot>

<!-- Welcome Area -->
<div class="welcome-area bg-gradient">
    <!-- Background Shape -->
    <div class="background-shape">
      <div class="circle1 wow fadeInRightBig" data-wow-duration="4000ms"></div>
      <div class="circle2 wow fadeInRightBig" data-wow-duration="4000ms"></div>
      <div class="circle3 wow fadeInRightBig" data-wow-duration="4000ms"></div>
      <div class="circle4 wow fadeInRightBig" data-wow-duration="4000ms"></div>
    </div>
    <!-- Background Animation -->
    <div class="background-animation">
      <div class="item1"></div>
      <div class="item2"></div>
      <div class="item3"></div>
      <div class="item4"></div>
      <div class="item5"></div>
    </div>
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-between">
        <!-- Welcome Content -->
        <div class="col-12 col-sm-10 col-md-6">
          <div class="welcome-content">
            <ul class="mb-0 ps-1 d-flex align-items-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="200ms">
              <li>Bootstrap 5</li>
              <li>Vanilla JS</li>
              <li>v2.0.0</li>
            </ul>
            <h2 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="300ms">Build an awesome website with ease.</h2>
            <p class="mb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="400ms">It's crafted with the latest trend of design &amp; coded with all modern approaches.</p>
            <div class="hero-btn-group wow fadeInUp" data-wow-duration="1s" data-wow-delay="500ms"><a class="btn btn-warning mt-3 me-3" href="{{ asset('storage/themes/theme2') }}/https://themeforest.net/item/saasbox-multipurpose-html-template-for-saas/25607146" target="_blank">Buy Now</a><a class="btn btn-light btn-minimal mt-3" href="{{ asset('storage/themes/theme2') }}/https://themeforest.net/item/saasbox-multipurpose-html-template-for-saas/reviews/25607146" target="_blank">Reviews (4.9/5.0)</a></div>
          </div>
        </div>
        <!-- Welcome Thumb -->
        <div class="col-12 col-sm-8 col-md-6">
          <div class="welcome-thumb ms-lg-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s"><img src="{{ asset('storage/themes/theme2') }}/img/illustrator/hero-3.png" alt=""></div>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-120 d-block"></div>
  <!-- Portfolio Area-->
  <div class="demo-show">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xxl-7">
          <div class="section-heading text-center">
            <div class="badge bg-primary d-inline-block mb-3">Home Page</div>
            <h2>Beautifully designed, hand-crafted coded,<span class="mx-1">4 </span>pre-built home page perfect for your website.</h2>
            <p>It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row g-5 demo-preview-area justify-content-center">
        <div class="col-12 col-md-6">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/creative-agency.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/home/ca.png" alt=""></a>
            <h5 class="mb-0 mt-4">Creative Agency</h5>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/business-studio.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/home/cb.png" alt=""></a>
            <h5 class="mb-0 mt-4">Business Studio</h5>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/saas-landing.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/home/sl.png" alt=""></a>
            <h5 class="mb-0 mt-4">Sass Landing</h5>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/seo-business.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/home/sb.png" alt=""></a>
            <h5 class="mb-0 mt-4">SEO Business</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-120 d-block"></div>
  <!-- Used Technology Area-->
  <div class="used-technology-area bg-gray pt-120 pb-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xxl-7">
          <div class="section-heading text-center">
            <h2> <span class="me-1">Built </span>with all <br> modern technologies.</h2>
            <p>It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p>
          </div>
        </div>
      </div>
      <div class="row g-0 border justify-content-center">
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/bootstrap.png" alt="">
            <h6 class="mb-0">Bootstrap 5.1.1</h6>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/js.png" alt="">
            <h6 class="mb-0">Vanilla JS</h6>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/npm.png" alt="">
            <h6 class="mb-0">NPM</h6>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/gulp.png" alt="">
            <h6 class="mb-0">Gulp 4</h6>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/pug.png" alt="">
            <h6 class="mb-0">PUG</h6>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/sass.png" alt="">
            <h6 class="mb-0">SASS</h6>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/css3.png" alt="">
            <h6 class="mb-0">CSS3</h6>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="demo-single-feature border py-4 px-3 text-center wow fadeInUp" data-wow-delay="200ms"><img class="mb-3" src="{{ asset('storage/themes/theme2') }}/img/demo-img/tpl/html5.png" alt="">
            <h6 class="mb-0">HTML5</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-120 d-block"></div>
  <div class="inner-page-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
          <div class="section-heading text-center">
            <div class="badge bg-primary d-inline-block mb-3">Inner Page</div>
            <h2>Awesome<span class="counter mx-2">32</span>inner pages for your all needs.</h2>
            <p>It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row g-5 saasbox-portfolio-filter">
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-creative.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/pc.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Creative</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-standard.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/ps.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Standard</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-full-width.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/p-full.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Full Width</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-details-one.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/pd1.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Details 1</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-details-two.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/pd2.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Details 2</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/portfolio-details-three.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/pd3.png" alt=""></a>
            <h5 class="mb-0 mt-4">Portfolio Details 3                    </h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/single-product.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/s-details.png" alt=""></a>
            <h5 class="mb-0 mt-4">Single Product</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/shop-fullwidth.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/s-full.png" alt=""></a>
            <h5 class="mb-0 mt-4">Shop Full Width</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/shop-sidebar.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/s-sidebar.png" alt=""></a>
            <h5 class="mb-0 mt-4">Shop with Sidebar</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/cart.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/cart.png" alt=""></a>
            <h5 class="mb-0 mt-4">Cart</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/checkout.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/checkout.png" alt=""></a>
            <h5 class="mb-0 mt-4">Checkout</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/about-creative.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/ac.png" alt=""></a>
            <h5 class="mb-0 mt-4">About Creative</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/about-standard.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/as.png" alt=""></a>
            <h5 class="mb-0 mt-4">About Standard</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-1.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/b1.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog 1</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-2.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/b2.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog 2</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-3.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/b3.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog 3</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-details-1.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/bd1.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog Details 1</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-details-2.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/bd2.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog Details 2</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/blog-details-3.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/bd3.png" alt=""></a>
            <h5 class="mb-0 mt-4">Blog Details 3</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/coming-soon.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/cs.png" alt=""></a>
            <h5 class="mb-0 mt-4">Coming Soon</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/contact.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/contact.png" alt=""></a>
            <h5 class="mb-0 mt-4">Contact</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/faq.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/faq.png" alt=""></a>
            <h5 class="mb-0 mt-4">FAQ</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/forget-password.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/forget.png" alt=""></a>
            <h5 class="mb-0 mt-4">Forget Password</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/login.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/login.png" alt=""></a>
            <h5 class="mb-0 mt-4">Login</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/newsletter.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/newsletter.png" alt=""></a>
            <h5 class="mb-0 mt-4">Newsletter</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/pricing-plan.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/pt.png" alt=""></a>
            <h5 class="mb-0 mt-4">Pricing Plan</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/register.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/register.png" alt=""></a>
            <h5 class="mb-0 mt-4">Register</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/reviews.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/reviews.png" alt=""></a>
            <h5 class="mb-0 mt-4">Reviews</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/service-creative.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/sc.png" alt=""></a>
            <h5 class="mb-0 mt-4">Service Creative</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/service-standard.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/ss.png" alt=""></a>
            <h5 class="mb-0 mt-4">Service Standard</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/team.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/team.png" alt=""></a>
            <h5 class="mb-0 mt-4">Team</h5>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 portfolio-item">
          <div class="single-preview-area text-center wow fadeInUp" data-wow-delay="200ms"><a href="{{ asset('storage/themes/theme2') }}/404.html" target="_blank"><img src="{{ asset('storage/themes/theme2') }}/img/demo-img/404.png" alt=""></a>
            <h5 class="mb-0 mt-4">404</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-120 d-block"></div>
  <div class="bg-gray pt-120 pb-120">
    <div class="container">
      <div class="row g-4 justify-content-center">
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">Bootstrap 5.1.1</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">Vanilla JavaScript</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">Node Package Manager</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">Gulp 4</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">Pug (formally Jade)</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">SASS</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">CSS Autoprefixer</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">CSS3</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-primary"></i>
            <h6 class="mb-0 d-inline-block text-primary">HTML5</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">4 Home Pages</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Shop Pages</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">6 Blog Layouts</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">6 Portfolio Pages</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">32 Inner Pages</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">100% Responsive</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Call to Action</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">CSS3 Animation</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Cookie Alert</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Counter Up</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Different Footer Style</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Easy To Customize</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">FAQ (Accordion)</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Bootstrap Icons</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Google Fonts</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Google Maps</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Icon Box</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Isotope Filtering</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Login &amp; Register</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Media Gallery</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Newsletter</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Premium Plugins</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Popup Video</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Pricing Table</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Retina Ready</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">SEO Optimized</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Tiny Slider</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Team Member</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Testimonials</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Tabs</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">WOW Animation</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Lot of Widgets</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Flag Icons</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Partner Slides</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Awesome Mobile Menu</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Forget Password</h6>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
          <div class="single-more-feature"><i class="bi bi-check-lg text-dark"></i>
            <h6 class="mb-0 d-inline-block">Coming Soon Countdown</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-user.app-layout>
