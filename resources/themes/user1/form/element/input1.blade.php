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


<div class="mb-3 {{ $col_class }}">
    @if ($type == 'text' || $type == 'number' || $type == 'password' || $type == 'file' || $type == 'email' || $type == 'date' || $type == 'datetime-local' || $type == 'url')
        <label for="{{ $name }}" class="form-label">
            {{ __($label) }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
        <input class="form-control" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }} {{ $attributes }}>
    @endif
    
    @if ($type == 'textarea')
        <label for="{{ $name }}" class="form-label">
            {{ __($label) }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
        <textarea class="form-control" name="{{ $name }}" id="{{ $name }}" cols="30" rows="10" {{ $required }} {{ $attributes }}>{{ old($name, $value) }}</textarea>
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
        <select name="{{ $name }}" id="{{ $name }}" class="form-control wide" {{ $attributes }} {{ $required }}>
            <option value="">{{ __('Choose...') }}</option>
            @foreach ($options as $i)
                <option value="{{ $i['id'] }}" {{ $i['id'] == $value ? 'selected' : '' }}>{{ __($i['name']) }}
                </option>
            @endforeach
        </select>
    @endif

    @if ($type == 'color')
        <div class="mb-3">
            <div class="example">
                <label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
                <input name="{{ $name }}" id="{{ $name }}"  type="text" class="as_colorpicker form-control" value="{{ $value }}" {{ $required }}>
            </div>
            
        </div>
    @endif

    @if ($type == 'date_picker')
        <div class="mb-3">
            <div class="example">
                <label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
                <input name="datepicker" class="datepicker-default form-control" id="datepicker">
            </div>
            
        </div>
    @endif


    @if ($type == 'hidden')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $attributes }}>
    @endif

     
    @if ($type == 'editor')
    <style>
         .cke_contents{
            height: 320px !important;
        }
    </style>
        <label for="{{ $name }}" class="form-label">
            {{ __($label) }}
            {!! $required == 'required' ? "<span class='text-danger'>*</span>" : '' !!}
        </label>
        <textarea class="ck_editor" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>{{ old($name, $value) }}</textarea>
        <script>
            $(function () {
                "use strict";
                CKEDITOR.replace('{{ $name }}')
            });
        </script>
    @endif


    @if ($type == 'tags')
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
            rel="stylesheet" />
        <style type="text/css">
            .bootstrap-tagsinput .tag {
                margin-right: 2px;
                color: white !important;
                background-color: #0d6efd;
                padding: 0.2rem;
                margin: 0.2rem;
                display: inline-block;
            }
            .bootstrap-tagsinput{padding: .6rem}
        </style>
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
            <input type="text" class="form-control p-4" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"  data-role="tagsinput" />
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        <script>
            $(function() {
                $('#{{ $name }}')
                    .on('change', function(event) {
                        var $element = $(event.target);
                        var $container = $element.closest('.example');

                        if (!$element.data('tagsinput')) return;

                        var val = $element.val();
                        if (val === null) val = 'null';
                        var items = $element.tagsinput('items');

                        $('code', $('pre.val', $container)).html(
                            $.isArray(val) ?
                            JSON.stringify(val) :
                            '"' + val.replace('"', '\\"') + '"'
                        );
                        $('code', $('pre.items', $container)).html(
                            JSON.stringify($element.tagsinput('items'))
                        );
                    })
                    .trigger('change');
                    $(".bootstrap-tagsinput").addClass('form-control');
            });
        </script>
    @endif

    @error($name)
        <x-form.validation-error :value="$message" />
    @enderror
</div>
