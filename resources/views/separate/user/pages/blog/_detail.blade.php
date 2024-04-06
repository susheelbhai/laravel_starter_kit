<div class="rts-blog-list-area rts-section-gap">
    <div class="container">
        <div class="row g-5">
            <!-- rts blo post area -->
            <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                <!-- single post -->
                <div class="blog-single-post-listing details mb--0">
                    <div class="thumbnail">
                        <img src="{{ asset($data['display_img']) }}" alt="Business-Blog">
                    </div>
                    <div class="blog-listing-content">
                        <div class="user-info">
                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-user-circle"></i>
                                <span>by {{ $data['author'] }}</span>
                            </div>
                            <!-- single infoe end -->
                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-clock"></i>
                                <span>{{ $data['created_at'] }}</span>
                            </div>
                            <!-- single infoe end -->
                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-tags"></i>
                                <span>{{ $data['category'] }}</span>
                            </div>
                            <!-- single infoe end -->
                        </div>
                        <h3 class="title animated fadeIn">{{ $data['title'] }}</h3>
                        {!! $data['long_description1'] !!}

                        @if ($data['highlighted_text1'] != null)
                            <div class="rts-quote-area text-center">
                                <h5 class="title">{{$data['highlighted_text1']}}</h5>
                            </div>
                        @endif
                        
                        {!! $data['long_description2'] !!}

                        @if ($data['highlighted_text2'] != null)
                            <div class="rts-quote-area text-center">
                                <h5 class="title">{{$data['highlighted_text2']}}</h5>
                            </div>
                        @endif
                        
                        {!! $data['long_description3'] !!}

                        
                        <div class="row  align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <!-- tags details -->
                                <div class="details-tag">
                                    <h6>Tags:</h6>
                                    <button>Services</button>
                                    <button>Business</button>
                                    <button>Growth</button>
                                </div>
                                <!-- tags details End -->
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="details-share">
                                    <h6>Share:</h6>
                                    <button><i class="fab fa-facebook-f"></i></button>
                                    <button><i class="fab fa-twitter"></i></button>
                                    <button><i class="fab fa-instagram"></i></button>
                                    <button><i class="fab fa-linkedin-in"></i></button>
                                </div>
                            </div>
                        </div>
                        
                         @relativeInclude('_comment')

                        
                    </div>
                </div>
                <!-- single post End-->
            </div>
            <!-- rts-blog post end area -->

        @relativeInclude('_sidebar')

        </div>
    </div>
</div>