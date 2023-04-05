@php
    $variables = [
        'home_page_url' => route('admin.dashboard'),
        'profile_page_url' => route('admin.profile.edit'),
        'logout_url' => route('admin.logout'),
    ];
@endphp
<x-theme.app :settings="$settings" :theme="$settings->user_theme" :user="$user" :profilepic="$profile_pic" :variables="$variables">

    <x-slot name="common_head_tag">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('storage/common/images/logo/' . $settings->favicon) }}">
        @livewireStyles
    </x-slot>

    <x-slot name="header">
        @relativeInclude('header')
    </x-slot>

    @isset($head)
        <x-slot name="head">
            {{ $head }}
        </x-slot>
    @endisset

    {{ $slot }}

    @livewireScripts
</x-theme.app>
