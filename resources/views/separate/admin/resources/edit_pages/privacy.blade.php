<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Privacy Policy Page | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Privacy Policy" action="{{ route('admin.pages.updatePrivacyPage') }}">
        @method('patch')
        <x-form.element.input1 name="content" label="Content" type="editor" :value="$data['content']" div="1" />
    </x-form.type.standard>

    
</x-layout.admin.app>
