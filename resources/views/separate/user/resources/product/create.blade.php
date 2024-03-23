<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Create Product | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Create Product" action="{{ route('product.store') }}">
                <x-form.element.form-group title="Product Detail">
                    <x-form.element.input1 name="sku" label="Product SKU" required="required" />
                    <x-form.element.input1 name="hsn_code" label="HSN Code" required="required" />
                    <x-form.element.input1 name="name" label="Product Name" required="required" />
                    <x-form.element.input1 name="description" label="Description" />
                    <x-form.element.input1 name="mrp" label="MRP" type="number" required="required" />
                    <x-form.element.input1 name="sale_price" label="Sale Price" type="number" required="required" />
                    <x-form.element.input1 name="purchase_price" label="Purchase Price" type="number" required="required" />
                    <x-form.element.input1 name="quantity" label="Quantity" required="required" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.user.app>
