<x-layout.guest>
    <x-slot name='head'>
        <link rel="icon" href="{{ asset('images/logo/'.config('app.favicon', 'dummy.png')) }}">
        {{ $head }}
    </x-slot>

    {{ $slot }}

</x-layout.guest>
