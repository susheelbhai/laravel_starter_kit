<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Product Application | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Edit Product Application" action="{{ route('product.update', $data['id']) }}">
                @method('patch')
                <x-form.element.form-group title="Product Detail">
                    <x-form.element.input1 name="sku" :value="$data['sku']" label="Product SKU" required="required" />
                    <x-form.element.input1 name="hsn_code" label="HSN Code" :value="$data['hsn_code']" required="required" />
                    <x-form.element.input1 name="name" :value="$data['name']" label="Product Name" required="required" />
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
