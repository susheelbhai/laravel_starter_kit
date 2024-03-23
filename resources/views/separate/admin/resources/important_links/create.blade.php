<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Important Link  | {{ config('app.name') }}</title>
    </x-slot>

    <x-form.type.standard title="Add Important Link" action="{{ route('admin.important_links.store') }}">
        <x-form.element.input1 name="name" label="Name" type="text" required="required" div="2" />
        <x-form.element.input1 name="href" label="href" type="text" required="required" div="2" />
        <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
    </x-form.type.standard>

</x-admin.app-layout>
