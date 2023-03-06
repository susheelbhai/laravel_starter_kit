
<div class="card">
    <div class="card-body">

        <div class="text-center mt-4">
            <div class="mb-3">
                <a href="" class="auth-logo">
                    <img src="{{ asset('storage/images/webpages/logo/' . $settings->dark_logo) }}" height="30" class="logo-dark mx-auto" alt="">
                    <img src="{{ asset('storage/images/webpages/logo/' . $settings->light_logo) }}" height="30" class="logo-light mx-auto" alt="">
                </a>
            </div>
        </div>

        <h4 class="text-muted text-center font-size-18"><b> {{ $name }}  </b></h4>

        <div class="p-3">
            <form class="form-horizontal mt-3" method="{{$method}}" action="{{ $action }}">
                @csrf
    <x-auth-session-status class="mb-4" :status="session('status')" />
            
                {{ $slot }}
            
            </form>
        </div>
        <!-- end -->
    </div>
    <!-- end cardbody -->
</div>
