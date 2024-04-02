@php
    $type = 'image';
    $placeholder = '';
    $col_class = '';
    $class = '';

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
<style>
    .avatar-upload .avatar-preview {
      padding-top: {{ $ratio }}%;
    }
</style>
@if ($type == 'image')
<div class="avatar-upload {{ $class }} {{ $col_class }}">
    <div class="avatar-preview">
        <div id="{{ $name }}Preview"
            style="background-image: url({{ $value }});">
        </div>
    </div>
    <div class="avatar-edit">
        <input class="custom_img_input" data-prview_id="{{ $name }}Preview" name="{{ $name }}" type='file' id="{{ $name }}"
            accept=".png, .jpg, .jpeg" {{ $required }} />
        <label for="{{ $name }}"> 
            {{ $label }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
    </div>
</div>
@endif

@if ($type == 'multi_img')
<div class="avatar-edit {{ $class }} {{ $col_class }}">
    <input class="custom_img_input" data-prview_id="{{ $name }}Preview" name="{{ $name }}" type='file' id="{{ $name }}"
        accept=".png, .jpg, .jpeg" multiple />
    <label for="{{ $name }}"> {{ $label }}</label>
</div>
@endif

@error($name)
        <x-form.validation-error :value="$message" />
@enderror