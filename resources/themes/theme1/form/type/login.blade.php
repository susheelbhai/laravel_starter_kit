<div class="col-xl-12" {{ $attributes->merge(["class"=>"defaultclass"]) }}>
    <div class="auth-form">
        <div class="text-center mb-3">
            <a href="{{ route('home') }}">
                <img src="{{ asset($setting->dark_logo ?? 'dummy.png') }}" width="120px">
            </a>
        </div>
        <h4 class="text-center mb-4">{{ $title }}</h4>
        <form action="{{ $action }}" method="post">
            @csrf
            {{ $slot }}
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">{{ $submitName }}</button>
            </div>
        </form>

    </div>
</div>