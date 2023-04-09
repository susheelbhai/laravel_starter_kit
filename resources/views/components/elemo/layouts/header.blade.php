<header id="header" class="transparent-header">
    <nav class="navbar navbar-expand-lg fixed-top" id="header_nav">
        <div class="container-fluid">
            <div class="row header_row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="navbar-header">
                        <div class="logo"> <a href="{{ route('home') }}"><img
                                    src="{{ asset('storage/images/webpages/logo/' . $settings->light_logo) }}"
                                    alt="image" width="120" /></a> </div>
                    </div>
                    <button id="menu_slide" data-bs-target="#navigation" aria-expanded="false" data-bs-toggle="collapse"
                        class="navbar-toggler" type="button">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>


                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            @foreach ($menu as $i)
                                <li class="@if (isset($i['menu2'])) menu-item-has-children @endif">
                                    <a href="{{ $i['href'] }}">{{ $i['name'] }}</a>
                                    @if (isset($i['menu2']))
                                        <span class="arrow"></span>
                                    @endif
                                    @if (isset($i['menu2']))
                                        <ul class="sub-menu">
                                            @foreach ($i['menu2'] as $j)
                                                <li
                                                    class="@if (isset($j['menu3'])) menu-item-has-children @endif">
                                                    <a href="{{ $j['href'] }}">{{ $j['name'] }}</a>
                                                    @if (isset($i['menu3']))
                                                        <span class="arrow"></span>
                                                    @endif
                                                    @if (isset($j['menu3']))
                                                        <ul class="sub-menu">
                                                            @foreach ($j['menu3'] as $k)
                                                                <li>
                                                                    <a href="{{ $k['href'] }}">{{ $k['name'] }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            
                        </ul>
                        <div class="submit_listing">
                            <a href="pricing.html" class="btn outline-btn"><i class="fa  fa-plus-circle"></i>
                                Submit Listing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
