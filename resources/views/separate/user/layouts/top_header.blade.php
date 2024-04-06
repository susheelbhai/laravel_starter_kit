<div class="header-top header-top-one bg-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-xl-block d-none">
                <div class="left">
                    <div class="mail">
                        <a href="mailto:{{ config('app.email') }}">
                            <i class="fal fa-envelope"></i> {{ config('app.email') }}
                        </a>
                    </div>
                    <div class="working-time">
                        <p><i class="fal fa-clock"></i> Working: 8.00am - 5.00pm</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-xl-block d-none">
                <div class="right">
                    <ul class="top-nav">
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                    <ul class="social-wrapper-one">
                        <li><a href="{{ config('app.facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ config('app.twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ config('app.instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a class="mr--0" href="{{ config('app.linkedin') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>