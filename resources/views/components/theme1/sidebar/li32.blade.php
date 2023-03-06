
@props(['lbl'=>'', 'href'=>'', 'icon'=>''])

<li>
    <a href="javascript: void(0);" class="has-arrow">
        <span>{{ $lbl }}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        {{ $slot }}
    </ul>
</li>