
<div class="rts-service-area rts-section-gapTop pb--200 service-two-bg bg_image">
    <div class="container">
        <div class="row g-5 service padding-controler">
            @foreach ($data as $i)
            <div class="col-xl-4 col-md-6 col-sm-12 col-12 pb--140 pb_md--100">
                <div class="service-two-inner">
                    <a href="{{ route('serviceDetail',$i['slug']) }}" class="thumbnail">
                        <img src="{{ asset($i['display_img']) }}" alt="Business_image">
                    </a>
                    <div class="body-content">
                        <div class="hidden-area">
                            <h5 class="title"> {{ $i['title'] }} </h5>
                            <p class="dsic">
                                {{ $i['short_description'] }}
                            </p>
                            <a class="rts-read-more-two color-primary" href="{{ route('serviceDetail',$i['slug']) }}">Read More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>