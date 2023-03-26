@php
    $type = 'text';
    $value = '';
    $required = '';
    $placeholder = '';
    $col_class = '';
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
        switch ($i['class']) {
            case 'col100':
                $col_class = 'col-12';
                break;
            case 'col50':
                $col_class = 'col-12 col-lg-6';
                break;
    
            default:
                $col_class = 'col-12';
                break;
        }
    }
    $name = $i['name'];
    $lbl = $i['lbl'];
    
@endphp


<div class="col {{ $col_class }}">

    @if ($type == 'text' || $type == 'email' || $type == 'date' || $type == 'number' || $type == 'url')
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
            <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
                placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $required }} />
        </div>
    @endif

    @if ($type == 'color')
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
            <input type="text" class="form-control colorpicker-default" id="{{ $name }}"
                name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
                {{ $required }} />
        </div>
    @endif

    @if ($type == 'select')
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
            <select class="form-select" name="{{ $name }}" id="{{ $name }}" {{ $required }}>
                <option value=""> Select ...</option>
                @foreach ($i['options'] as $j)
                    <option value="{{ $j['value'] }}" @if ($j['value'] == $value) selected @endif>
                        {{ $j['lbl'] }}</option>
                @endforeach
            </select>

        </div>
    @endif

    @if ($type == 'editor')
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
            <textarea {{ $required }} class="form-control" id="{{ $name }}" name="{{ $name }}"
                placeholder="{{ $placeholder }}" rows="5" name="{{ $name }}">{!! $value !!}</textarea>
            <script>
                ClassicEditor
                    .create(document.querySelector('#{{ $name }}'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>

        </div>
    @endif

    @if ($type == 'switch')
        <div class="mb-3"> </div>
        <div class="form-check form-switch mb-3" dir="ltr">
            <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}"
                @if ($value == 1) checked @endif>
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
        </div>
    @endif

    @if ($type == 'textarea')
        <div class="mb-3">
            <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
            <textarea {{ $required }} class="form-control" id="{{ $name }}" name="{{ $name }}"
                placeholder="{{ $placeholder }}" rows="5" name="{{ $name }}">{{ $value }}</textarea>
        </div>
    @endif

    @error($name)
        @foreach ((array) $errors->get($name) as $message)
            <span class="text-danger"> {!! $message !!} </span>
        @endforeach
    @enderror

</div>
