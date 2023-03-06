
@props(['options'])


@if ($type == 'text' || $type == 'url')
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $lbl }}" value="{{ $value }}" required />
    @error($name)
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    @enderror
</div>
@endif

@if ($type == 'color')
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
    <input type="text" class="form-control colorpicker-default" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $lbl }}" value="{{ $value }}" required />
    @error($name)
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    @enderror
</div>
@endif

@if ($type == 'select')
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
    <select class="form-select" name="{{ $name }}" id="{{ $name }}" required>
        <option value=""> Select ...</option>
        @foreach ($options as $j)
            <option value="{{ $j['value'] }}" @if($j['value']== $value) selected @endif > {{ $j['lbl'] }}</option>
        @endforeach
    </select>
    
</div>
@endif

@if ($type == 'editor')
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
        <textarea required class="form-control" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $lbl }}" rows="5" name="{{ $name }}"> {!! $value !!} </textarea>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#{{ $name }}' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>
    
</div>
@endif

@if ($type == 'switch')
<div class="mb-3">
    
    
</div>
<div class="form-check form-switch mb-3" dir="ltr">
    <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}" @if($value == 1) checked @endif >
    <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
</div>
@endif

@if ($type == 'textarea')
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label">{{ $lbl }}</label>
        <textarea required class="form-control" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $lbl }}" rows="5" name="{{ $name }}"> {{ $value }} </textarea>
        

    </div>
@endif
