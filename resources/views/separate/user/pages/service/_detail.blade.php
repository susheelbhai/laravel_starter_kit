<div class="rts-service-details-area rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                <!-- service details left area start -->
                <div class="service-detials-step-1">
                    <div class="thumbnail">
                        <img src="{{ asset($data['display_img']) }}" alt="business-area">
                    </div>
                    <h4 class="title">{{ $data['title'] }}</h4>
                    {!! $data['long_description1'] !!}
                </div>
                <div class="service-detials-step-2 mt--40">
                    {!! $data['long_description2'] !!}
                </div>
                <!-- service details left area end -->
                <div class="service-detials-step-3 mt--70 mt_md--50">
                    {!! $data['long_description3'] !!}
                </div>
            </div>
            <!--rts blog wizered area -->
            @relativeInclude('_sidebar')
            <!-- rts- blog wizered end area -->
        </div>
    </div>
</div>
