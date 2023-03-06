@props(['heading', 'details'])

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $heading }}</h4>
                @if (isset($para))
                    <p class="card-title-desc"> {{ $para }} </p>
                @endif

                <form class="needs-validation" method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data" >
                    @csrf
                    {{ $slot }}
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($details as $key => $i)
                            
                            @if (isset($i['image']))
                                <x-partner.form.input-img1 name="{{ $i['name'] }}" lbl="{{ $i['lbl'] }}" type="file" value="{{ $i['value'] ?? '' }}" required="{{ $required ?? ''}}" />
                            @elseif(isset($i['options']))
                                <x-partner.form.input1 name="{{ $i['name'] }}" lbl="{{ $i['lbl'] }}" value="{{ $i['value'] ?? '' }}" type="select" :options="$i['options']" required="{{ $required ?? ''}}"  />
                            @else
                                <x-partner.form.input1 name="{{ $i['name'] }}" lbl="{{ $i['lbl'] }}" type="{{ $i['type'] ?? 'text' }}" value="{{ $i['value'] ?? '' }}" required="{{ $required ?? ''}}"  />
                            @endif
                                
                            @endforeach
                        </div>
                    </div>
                    
                    @if (isset($agreement))
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                    @endif

                    <div>
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
