<x-layout.user.app>

    <x-slot name="head">
        <title>{{ config('app.name') }}</title>
    </x-slot>
    @relativeInclude('_hero')
    @relativeInclude('_about')
    @relativeInclude('_service')
    @relativeInclude('_we_do')
    @relativeInclude('_counter')
    @relativeInclude('_gallery')
    @relativeInclude('_client')
    @relativeInclude('_team')
    @relativeInclude('_feature')
    @relativeInclude('_testimonial')
    @relativeInclude('_news')
    @relativeInclude('_contact')
</x-layout.user.app>