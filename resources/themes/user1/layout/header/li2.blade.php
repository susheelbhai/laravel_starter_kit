<li class="has-droupdown">
    <a class="nav-link" href="javascript:void()">{{ $name }}</a>
    <ul class="submenu @if($style==2) menu-link1 @endif">
        {{ $slot }}
    </ul>
</li>
