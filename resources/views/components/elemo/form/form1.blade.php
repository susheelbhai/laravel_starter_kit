@props(['heading', 'details'])

<form class="needs-validation" method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data" >
    @csrf
    {{ $slot }}
    <div class="row">
        @foreach ($details as $key => $i)
            
        @if (isset($i['image']))
            <x-partner.form.input-img1 name="{{ $i['name'] }}" lbl="{{ $i['lbl'] }}" type="file" value="{{ $i['value'] ?? '' }}" required="{{ isset($i['required']) ? 'required' : ''}}" />
        @else
           @relativeInclude('input1')
        @endif
            
        @endforeach
    </div>
    

    <div class="col-12 text-center">
        <button class="btn btn-primary w-100" type="submit">Send Now</button>
    </div>
</form>
