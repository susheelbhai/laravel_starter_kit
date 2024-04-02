

@php
    switch ($div) {
        case 1:
            $col_class = 'col-md-12';
            break;
        case 2:
            $col_class = 'col-md-6';
            break;
        case 3:
            $col_class = 'col-md-4';
            break;
        case 4:
            $col_class = 'col-md-3';
            break;
        case 6:
            $col_class = 'col-md-2';
            break;
        case 12:
            $col_class = 'col-md-1';
            break;

        default:
            $col_class = 'col-md-6';
            break;
    }
@endphp

<div class="{{ $col_class }}">
    <div class="card">
        <img class="card-img-top img-fluid" src="{{ $src }}" alt="Card image cap">
        {{ $slot }}
    </div>
</div>