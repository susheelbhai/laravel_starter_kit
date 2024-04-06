<x-layout.user.app>
    <x-slot name="head">
        <title>Contact Us | {{ config('app.name') }}</title>
    </x-slot>

    <x-ui.breadcrumb name='About Us' />
    
    @relativeInclude('_about')
    

    
</x-ui.user.breadcrumb>