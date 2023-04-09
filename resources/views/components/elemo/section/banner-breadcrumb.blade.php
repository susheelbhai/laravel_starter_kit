<div class="breadcrumb-wrapper bg-img bg-overlay" style="background-image: url('{{ $breadcrumb_data['img_url'] }}');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="breadcrumb-title">{{$breadcrumb_data['heading']}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                              <a href="{{$breadcrumb_data['breadcrumb']['lavel1']['url']}}">
                                {{$breadcrumb_data['breadcrumb']['lavel1']['name']}}
                              </a>
                            </li>
                            
                            <li class="breadcrumb-item @isset($breadcrumb_data['breadcrumb']['lavel3']) active @endisset" aria-current="page">
                              @isset($breadcrumb_data['breadcrumb']['lavel3']) 
                              <a href="{{$breadcrumb_data['breadcrumb']['lavel2']['url']}}">
                                {{$breadcrumb_data['breadcrumb']['lavel2']['name']}}
                              </a>
                              @else
                              {{$breadcrumb_data['breadcrumb']['lavel2']['name']}}
                              @endisset
                            </li>

                            @isset($breadcrumb_data['breadcrumb']['lavel3']) 
                              
                            <li class="breadcrumb-item @isset($breadcrumb_data['breadcrumb']['lavel4']) active @endisset" aria-current="page">
                              @isset($breadcrumb_data['breadcrumb']['lavel4']) 
                              <a href="{{$breadcrumb_data['breadcrumb']['lavel3']['url']}}">
                                {{$breadcrumb_data['breadcrumb']['lavel3']['name']}}
                              </a>
                              @else
                              {{$breadcrumb_data['breadcrumb']['lavel3']['name']}}
                              @endisset
                            </li>

                              @endisset

                            @isset($breadcrumb_data['breadcrumb']['lavel4']) 
                              
                            <li class="breadcrumb-item active" aria-current="page">
                              {{$breadcrumb_data['breadcrumb']['lavel3']['name']}}
                            </li>

                              @endisset


                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
