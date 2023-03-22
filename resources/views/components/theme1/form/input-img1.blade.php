@php
    $type = 'text';
    $value = '';
    $required = '';
    $placeholder = '';
    $col_class = '';
    $class = '';
    if (isset($i['type'])) {
       $type = $i['type'];
    }
    if (isset($i['value'])) {
       $value = $i['value'];
    }
    if (isset($i['required'])) {
       $required = $i['required'];
    }
    if (isset($i['placeholder'])) {
       $placeholder = $i['placeholder'];
    }
    if (isset($i['class'])) {
        if ($i['class'] == 'col50') {
            $col_class = 'col-6';
            $class = $i['class'];
        }
        
    }
    $name = $i['name'];
    $lbl = $i['lbl'];

@endphp

<div class="avatar-upload {{ $class }} {{ $col_class }}">
    <div class="avatar-preview">
        <div id="{{ $name }}Preview"
            style="background-image: url({{ $value }});">
        </div>
    </div>
    <div class="avatar-edit">
        <input class="custom_img_input" data-prview_id="{{ $name }}Preview" name="{{ $name }}" type='file' id="{{ $name }}"
            accept=".png, .jpg, .jpeg" />
        <label for="{{ $name }}"> {{ $lbl }}</label>
    </div>
</div>
