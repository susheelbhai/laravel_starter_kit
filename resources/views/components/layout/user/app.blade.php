<x-layout.app>
    <x-slot name='head'>
        <link rel="icon" href="{{ asset(config('app.favicon', 'dummy.png')) }}">
        {{ $head }}
        @livewireStyles
    </x-slot>

    <x-slot name='header_profile_li'>
        {{-- @relativeInclude('header_profile_li') --}}
    </x-slot>
    <form id="logout_form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>

    <x-slot name='header_logo'>
        @include('user.layouts.header_logo')
    </x-slot>

    <x-slot name='header'>
        @include('user.layouts.header')
    </x-slot>

    {{ $slot }}


    <script>
        function logoutSubmit() {
            document.getElementById('logout_form').submit();
        }
    </script>

</x-layout.app>
