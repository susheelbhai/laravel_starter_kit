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
@if ($type == 'add')
    <div class="mb-3 {{ $col_class }}">
        <button type="button" class="btn btn-primary" {{ $attributes }}> <i class="fa fa-plus"></i>
            <span class="btn-icon-end"> {{ $title }} </span>
        </button>
    </div>
@endif

@if ($type == 'submit')
    <div class="mb-3 {{ $col_class }}">
        <button type="{{ $type }}" class="btn btn-primary" {{ $attributes }}>
            {{ $title }}
        </button>
    </div>
@endif
