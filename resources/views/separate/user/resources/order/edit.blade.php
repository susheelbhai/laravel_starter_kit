<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Order Application | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Edit Order Application" action="{{ route('order.update', $data['id']) }}">
                @method('patch')
                <x-form.element.form-group title="Order Detail">
                    <x-form.element.input1 name="sku" :value="$data['sku']" label="Order SKU" required="required" />
                    <x-form.element.input1 name="name" :value="$data['name']" label="Order Name" required="required" />
                    <x-form.element.input1 name="description" :value="$data['description']" label="Description" />
                    <x-form.element.input1 name="mrp" :value="$data['mrp']" label="MRP" type="number" required="required" />
                    <x-form.element.input1 name="sale_price" :value="$data['sale_price']" type="number" label="Sale Price" required="required" />
                    <x-form.element.input1 name="purchase_price" :value="$data['purchase_price']" type="number" label="Purchase Price" required="required" />
                    <x-form.element.input1 name="quantity" :value="$data['quantity']" label="Quantity" required="required" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.user.app>
