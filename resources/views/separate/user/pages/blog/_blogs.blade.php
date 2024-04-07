<div class="rts-blog-grid-area rts-section-gap">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-8 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                <div class="row g-5">
                    @foreach ($data as $i)
                        
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <!-- start blog grid inner -->
                        <div class="blog-grid-inner">
                            <div class="blog-header">
                                <a class="thumbnail" href="{{ route('blog.show',$i['slug']) }}">
                                    <img src="{{ asset($i['display_img']) }}" alt="Business_Blog">
                                </a>
                                <div class="blog-info">
                                    <div class="user">
                                        <i class="fal fa-user-circle"></i>
                                        <span>by {{ $i['author'] }}</span>
                                    </div>
                                    <div class="user">
                                        <i class="fal fa-tags"></i>
                                        <span>{{ $i['category'] }}</span>
                                    </div>
                                </div>
                                <div class="date">
                                    <h6 class="title">{{ date_format(date_create($data['created_at']), 'd') }}</h6>
                                    <span>{{ date_format(date_create($data['created_at']), 'M') }}</span>
                                </div>
                            </div>
                            <div class="blog-body">
                                <a href="{{ route('blog.show',$i['slug']) }}">
                                    <h5 class="title">
                                        {{ $i['title'] }}
                                    </h5>
                                </a>
                            </div>
                        </div>
                        <!-- end blog grid inner -->
                    </div>
                    @endforeach
                    
                </div>
                {{-- {{ $data->Links() }} --}}
            </div>
        @relativeInclude('_sidebar')

        </div>
    </div>
</div>