
@props(['href'=>'', 'lbl'=>'', 'icon'=>''])

<li>
    <a href="{{ $href }}" class="waves-effect">
        <i class="{{ $icon }}"> </i>
        @if(isset($badge)) <span class="badge rounded-pill bg-success float-end">3</span> @endif
        <span>{{ $lbl }}</span>
    </a>
</li>