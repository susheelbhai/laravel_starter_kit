<x-layout.user.app>
    <x-slot name="head">
        <title>{{ $data['title'] }} | {{ config('app.name') }}</title>
    </x-slot>
    <x-ui.breadcrumb name='Blog' />

    </div>
    @relativeInclude('_detail') 

    
</x-layout.user.app>