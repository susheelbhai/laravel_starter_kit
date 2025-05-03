<form method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data" {{ $attributes }}>
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="row">
                            {{ $slot }}

                            @if ($action != '#' && $submitBtn == true)
                                <button type="submit" class="btn btn-primary">{{ __($submitName) }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>