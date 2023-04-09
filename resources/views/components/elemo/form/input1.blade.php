
@if (!isset($i['type']))
@php $i['type'] ='text' @endphp
@endif
@if (!isset($i['value']))
@php $i['value'] ='' @endphp
@endif
@if (!isset($i['required']))
@php $i['required'] ='' @endphp
@endif

@if ($i['type'] == 'text' || $i['type'] == 'url')
<div class="{{ $i['class'] ?? '' }}">
    <label class="form-label" for="{{ $i['name'] }}">{{ $i['lbl'] }}</label>
    <input class="form-control mb-30" id="{{ $i['name'] }}" type="text"
        placeholder="{{ $i['lbl'] }}" value="{{ $i['value'] }}" name="{{ $i['name'] }}" {{ $i['required'] }}>
</div>

@endif

@if ($i['type'] == 'color')
    <div class="mb-3">
        <label for="{{ $i['name'] }}" class="form-label">{{ $i['lbl'] }}</label>
        <input type="text" class="form-control colorpicker-default" id="{{ $i['name'] }}"
            name="{{ $i['name'] }}" placeholder="{{ $i['lbl'] }}" value="{{ $i['value'] }}"
            {{ $i['required'] }} />
    </div>
@endif

@if ($i['type'] == 'select')
    <div class="mb-3">
        <label for="{{ $i['name'] }}" class="form-label">{{ $i['lbl'] }}</label>
        <select class="form-select" name="{{ $i['name'] }}" id="{{ $i['name'] }}" {{ $i['required'] }}>
            <option value=""> Select ...</option>
            @foreach ($options as $j)
                <option value="{{ $j['value'] }}" @if ($j['value'] == $i['value']) selected @endif>
                    {{ $j['lbl'] }}</option>
            @endforeach
        </select>

    </div>
@endif

@if ($i['type'] == 'editor')
    <div class="mb-3">
        <label for="{{ $i['name'] }}" class="form-label">{{ $i['lbl'] }}</label>
        <textarea {{ $i['required'] }} class="form-control" id="{{ $i['name'] }}" name="{{ $i['name'] }}"
            placeholder="{{ $i['lbl'] }}" rows="5" name="{{ $i['name'] }}">{!! $i['value'] !!}</textarea>
        <script>
            ClassicEditor
                .create(document.querySelector('#{{ $i['name'] }}'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

    </div>
@endif

@if ($i['type'] == 'switch')
    <div class="mb-3"> </div>
    <div class="form-check form-switch mb-3" dir="ltr">
        <input type="checkbox" class="form-check-input" id="{{ $i['name'] }}" name="{{ $i['name'] }}"
            @if ($i['value'] == 1) checked @endif>
        <label for="{{ $i['name'] }}" class="form-label">{{ $i['lbl'] }}</label>
    </div>
@endif

@if ($i['type'] == 'textarea')
    <div class="{{ $i['class'] ?? '' }}">
        <label for="{{ $i['name'] }}" class="form-label">{{ $i['lbl'] }}</label>
        <textarea {{ $i['required'] }} class="form-control mb-30" id="{{ $i['name'] }}" name="{{ $i['name'] }}"
            placeholder="{{ $i['lbl'] }}" rows="5" name="{{ $i['name'] }}">{{ $i['value'] }}</textarea>
    </div>
@endif

@error($i['name'])
    @foreach ((array) $errors->get($i['name']) as $message)
        <span class="text-danger"> {!! $message !!} </span>
    @endforeach
@enderror
