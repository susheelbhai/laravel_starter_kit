
<div class="row" {{ $attributes->merge(["class"=>"defaultclass"]) }}>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{ $slot }}

                            @if ($action != '#')
                                <button type="submit" class="btn btn-primary">{{ $submitName }}</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>