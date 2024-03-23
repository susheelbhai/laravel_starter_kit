<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Create Customer | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Create Customer" action="{{ route('customer.store') }}">
                <x-form.element.form-group title="Customer Detail">
                    <x-form.element.input1 name="name" label="Customer Name" required="required" />
                    <x-form.element.input1 name="email" label="Customer Email" type="email" />
                    <x-form.element.input1 name="phone" label="Customer Phone" />
                    <x-form.element.input1 name="address" label="Address" required="required" />
                    <x-form.element.input1 name="city" label="City" required="required" />
                    <x-form.element.input1 name="pin" label="Pin Code" type="number" required="required" />
                    <x-form.element.input1 name="state_id" label="State" type="select" :options="$states" required="required" />
                    <x-form.element.input1 name="gstin" label="GSTIN" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.user.app>
