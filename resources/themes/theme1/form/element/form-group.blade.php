<div  {{ $attributes->merge(["class"=>"col-12"]) }}>
    <div class="field_set">
        <h3>{{ $title }}</h3>
        <div class="row">
            {{$slot}}
        </div>
    </div>
</div>