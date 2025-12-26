<x-layout.app>
    <x-slot name='head'>
        <link rel="icon" href="{{ asset(config('app.favicon', 'dummy.png')) }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('themes/ck_editor/js/vendors.min.js') }}"></script>
        <script src="{{ asset('themes/ck_editor/vendor_components/ckeditor/ckeditor.js') }}"></script>
        {{ $head }}
    </x-slot>

    <x-slot name='header_logo'>
        @include('seller.layouts.header_logo')
    </x-slot>

    <x-slot name='header_profile_box'>
        @include('seller.layouts.header_profile_box')
    </x-slot>

    <x-slot name='header_profile_li'>
        @include('seller.layouts.header_profile_li')
    </x-slot>

    <form id="logout_form" action="{{ route('seller.logout') }}" method="post">
        @csrf
    </form>

    <x-slot name='sidebar'>
        @include('seller.layouts.sidebar')
    </x-slot>

    {{ $slot }}
    
    <script>
        function logoutSubmit() {
            document.getElementById('logout_form').submit();
        }
    </script>
    
</x-layout.app>
