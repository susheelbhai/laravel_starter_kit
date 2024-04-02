
<style>
    .field_set {
    border: 2px solid #ddd;
    padding: 25px 15px 15px 15px;
    background: #fff;
    margin-top: 44px;
    border-radius: 9px;
    position: relative;
    margin-bottom: 10px;
}
    .field_set h3 {
    background: #fff;
    color: #50398c;
    padding: 8px 10px 0 10px;
    margin: 0 -15px 0 15px;
    margin-bottom: 14px;
    /* margin-top: -15px !important; */
    position: relative;
    /* max-width: 128px; */
    /* margin: 0 auto; */
    text-align: center;
    margin-top: -50px;
    margin-bottom: 36px;
    font-size: 24px;
    /* margin-left: 1px; */
    transform: rotate90;
    transform: rotate(deg);
    /* border: 1px solid #50398c; */
    /* margin-left: 0 !important; */
    font-weight: 600;
    position: absolute;
}
</style>

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