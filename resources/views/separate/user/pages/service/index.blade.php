<x-layout.user.app>
    <x-slot name="head">
        <title>Services | {{ config('app.name') }}</title>
    </x-slot>
    
    <x-ui.breadcrumb name='Services' />

    @relativeInclude('_servicess')
    

    
</x-layout.user.app>