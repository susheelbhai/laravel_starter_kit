<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Home | {{ config('app.name') }}</title>
    </x-slot>
        
        @relativeInclude('_hero')
        @relativeInclude('_client')
        @relativeInclude('_we_do')
        @relativeInclude('_service')
        @relativeInclude('_case_studies')
        @relativeInclude('_about')
        @relativeInclude('_testimonial')
        @relativeInclude('_project')
        @relativeInclude('_news')
        @relativeInclude('_feature')
        @relativeInclude('_contact')
    
</x-layout.user.app>
