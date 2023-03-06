
@props(['lbl'=>'', 'href'=>'', 'icon'=>''])

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="{{ $icon }}"></i>
        <span>{{ $lbl }}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        {{ $slot }}
    </ul>
</li>