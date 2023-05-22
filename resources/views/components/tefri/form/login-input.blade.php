@if ($type == 'text' || $type == 'email' || $type == 'number' || $type == 'password')
    <div class="form-group mb-3">
        <input name="{{ $name }}" class="form-control" type="{{ $type }}" {{ $attributes }}
                placeholder="{{ $lbl }}" value="{{ $value ?? old($name) }}">
            @error($name)
                @foreach ((array) $errors->get($name) as $message)
                    <span class="text-danger"> {!! $message !!} </span>
                @endforeach
                
            @enderror

            @if($errors->updatePassword->get($name) != null)
                @foreach ((array) $errors->updatePassword->get($name) as $message)
                    <span class="text-danger"> {!! $message !!} </span>
                @endforeach
            @endif
            
    </div>
@endif


@if ($type == 'checkbox')
<div class="form-check mt-3">
    <input name="remember" class="form-check-input" id="rememberMe" type="checkbox" value="" checked>
    <label class="form-check-label" for="rememberMe">Keep me logged in</label>
</div>
@endif

@if ($type == 'footer_link')
<div class="login-meta-data d-flex align-items-center justify-content-between">
    
    @if (Route::has($value))
        <a class="forgot-password mt-3" href="{{ route($value) }}">{{ $lbl }}</a>
    @endif
</div>
@endif


@if ($type == 'submit')
    <div class="form-group mb-3 text-center row mt-3 pt-1">
        <div class="col-12">
            <button class="btn btn-info w-100 waves-effect waves-light" type="submit"> {{ $lbl }} </button>
        </div>
    </div>
@endif
