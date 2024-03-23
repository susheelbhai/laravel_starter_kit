<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Customer Application | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Edit Customer Application" action="{{ route('customer.update', $data['id']) }}">
                @method('patch')
                <x-form.element.form-group title="Customer Detail">
                    <x-form.element.input1 name="name" :value="$data['name']" label="Customer Name" required="required" />
                    <x-form.element.input1 name="email" :value="$data['email']" label="Customer Email" type="email" />
                    <x-form.element.input1 name="phone" :value="$data['phone']" label="Customer Phone" />
                    <x-form.element.input1 name="address" :value="$data['address']" label="Address" required="required" />
                    <x-form.element.input1 name="city" :value="$data['city']" label="City" required="required" />
                    <x-form.element.input1 name="pin" :value="$data['pin']" label="Pin Code" type="number" required="required" />
                    <x-form.element.input1 name="state_id" :value="$data['state_id']" label="State" type="select" :options="$states" required="required" />
                    <x-form.element.input1 name="gstin" label="GSTIN" :value="$data['gstin']" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.user.app>
