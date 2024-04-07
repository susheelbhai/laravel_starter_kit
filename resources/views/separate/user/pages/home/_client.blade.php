<div class="rts-trusted-client rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-area-client text-center">
                    <p class="client-title">Our Trusted Clients</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="client-wrapper-one">
                @foreach ($clients as $i)
                    <a href="{{ url($i['url']) }}" target="_blank"><img src="{{ asset($i['logo']) }}" alt="{{ $i['name'] }}"></a>
                @endforeach
            </div>
        </div>
    </div>
</div>