<x-layout.user.app>
    <x-slot name="head">
        <title>Contact Us | {{ config('app.name') }}</title>
    </x-slot>
    
    <x-ui.breadcrumb name='Contact Us' />

    @relativeInclude('_contact')
    
</x-layout.user.app>