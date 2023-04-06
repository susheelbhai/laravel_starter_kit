@if ($type == 'text' || $type == 'email' || $type == 'number' || $type == 'password')
    <div class="form-group mb-3 row">
        <div class="col-12">
            <input name="{{ $name }}" id="{{ $name }}" class="form-control" type="{{ $type }}" required=""
                placeholder="{{ $lbl }}" value="{{ $value ?? old($name) }}">
            @error($name)
                @foreach ((array) $errors->get($name) as $message)
                    <span class="text-danger"> {!! $message !!} </span>
                @endforeach
            @enderror
        </div>
    </div>
@endif


@if ($type == 'checkbox')
    <div class="form-group mb-3 row">
        <div class="col-12">
            <div class="custom-control custom-checkbox">
                <input name="{{ $name }}" type="checkbox" class="custom-control-input" id="{{ $name }}">
                <label class="form-label ms-1" for="{{ $name }}">{{ $lbl }}</label>
            </div>
        </div>
    </div>
@endif

@if ($type == 'footer_link')
    <div class="form-group mb-0 row mt-2">
        @if (Route::has($value))
            <div class="col-sm-7 mt-3">
                <a href="{{ route($value) }}" class="text-muted"><i class="mdi mdi-lock"></i> {{ $lbl }} </a>
            </div>
        @endif
    </div>
@endif


@if ($type == 'submit')
    <div class="form-group mb-3 text-center row mt-3 pt-1">
        <div class="col-12">
            <button id="{{ $name }}" class="btn btn-info w-100 waves-effect waves-light" type="submit"> {{ $lbl }} </button>
        </div>
    </div>
@endif
