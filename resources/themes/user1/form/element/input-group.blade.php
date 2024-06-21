@php

    switch ($div) {
        case 1:
            $col_class = 'col-md-12';
            break;

        default:
            $col_class = 'col-md-6';
            break;
    }
    
@endphp

<style>
    .input-group-text:hover{cursor: pointer;}
</style>

<div class="mb-3 {{ $col_class }}">
    @if ($type == 'text' || $type == 'number' || $type == 'password' || $type == 'file' || $type == 'email')
        <label for="{{ $name }}" class="form-label">
            <strong>{{ __($label) }}</strong>
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
        <div class="input-group mb-3 input-primary">
            <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }} {{ $attributes }}>
            <span class="input-group-text" onclick="{{ $onclick }}">{{ $btn_name }}</span>
        </div>
    @endif

    @if ($type == 'switch')
        <label for="{{ $name }}" class="form-label">
            {{ __($label) }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label> <br>
        <label class="slide_check_box_toggle" for="{{ $name }}">
            <input name="{{ $name }}" id="{{ $name }}" type="checkbox"
                {{ $value == 1 ? 'checked' : '' }} {{ $attributes }}>
            <span class="slide_check_box"></span>
            <span class="slide_check_box_labels" data-on="Active" data-off="Not Active"></span>
        </label>
    @endif

    @if ($type == 'select')
        <label class="form-label">
            {{ __($label) }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
        <select name="{{ $name }}" id="{{ $name }}" class="form-control wide" {{ $attributes }}>
            <option value="">Choose...</option>
            @foreach ($options as $i)
                <option value="{{ $i->id }}" {{ $i->id == $value ? 'selected' : '' }}>{{ $i->name }}
                </option>
            @endforeach
        </select>
    @endif

    @if ($type == 'hidden')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $attributes }}>
    @endif

    @if ($type == 'remember')
        <div class="row d-flex justify-content-between mt-4 mb-2">
            <div class="mb-3">
                <div class="form-check custom-checkbox ms-1">
                    <input type="checkbox" class="form-check-input" id="{{ $name }}" {{ $attributes }}>
                    <label class="form-check-label" for="{{ $name }}">
                        {{ __($label) }}
                    </label>
                </div>
            </div>
        </div>
    @endif

    @error($name)
        <x-form.validation-error :value="$message" />
    @enderror
</div>
