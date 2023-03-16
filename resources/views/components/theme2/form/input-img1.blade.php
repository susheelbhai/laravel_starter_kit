<div class="avatar-upload text-center">
    <div class="avatar-preview">
        <div id="{{ $name }}Preview"
            style="background-image: url({{ $value }});">
        </div>
    </div>
    <div class="avatar-edit">
        <input class="custom_img_input" data-prview_id="{{ $name }}Preview" name="{{ $name }}" type='file' id="{{ $name }}"
            accept=".png, .jpg, .jpeg" />
        <label for="{{ $name }}"> {!! $lbl !!}</label>
    </div>
</div>
