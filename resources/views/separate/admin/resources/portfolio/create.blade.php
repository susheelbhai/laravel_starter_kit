<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Portfolio | {{ config('app.name') }}</title>
    </x-slot>


    <x-form.type.standard title="Add Portfolio" action="{{ route('admin.portfolio.store') }}">
        <div class="col-6">
            <div class="row">
                <x-form.element.input1 name="name" label="Name" type="text" required="required" div="1" />
                <x-form.element.input1 name="url" label="url" type="url" required="required" div="1" />
                <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
            </div>
        </div>
        <x-form.element.input-img name="image" :value="asset('images/portfolios/'.'dummy.png')" label="Logo" type="image" div="4" ratio="56.25" />
        
    </x-form.type.standard>

</x-admin.app-layout>
