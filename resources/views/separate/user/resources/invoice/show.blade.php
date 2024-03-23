<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Invoice Settings | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            <x-form.type.standard title="Invoice Setting" action="{{ route('invoice.setting.update') }}">
                @method('patch')
                <x-form.element.input1 name="gstin" :value="$data['gstin']" type="switch"
                    label="GSTIN" />
                <x-form.element.input1 name="pan" :value="$data['pan']" type="switch"
                    label="PAN" />
                <x-form.element.input1 name="bank_detail" :value="$data['bank_detail']" type="switch"
                    label="Bank Detail" />
                <x-form.element.input1 name="payment_terms" :value="$data['payment_terms']" type="switch"
                    label="Payment Terms" />
                <x-form.element.input1 name="authorised_sign" :value="$data['authorised_sign']" type="switch"
                    label="Authorised Signature" />
                <x-form.element.input1 name="authorised_stamp" :value="$data['authorised_stamp']" type="switch"
                    label="Authorised Stamp" />
                <x-form.element.input1 name="amount_in_words" :value="$data['amount_in_words']" type="switch"
                    label="Amount in words" />
            </x-form.type.standard>

        </div>
    </section>
</x-layout.user.app>
