<x-layout.partner.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Create Business | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Create Business" action="{{ route('partner.business_application.store') }}">
                <x-form.element.form-group title="Business Detail">
                    <x-form.element.input1 name="name" label="Business Name" required="required" />
                    <x-form.element.input1 name="logo" label="Business Logo" type="file" />
                    <x-form.element.input1 name="registration_number" label="Registration Number" />
                    <x-form.element.input1 name="registration_certificate" label="Registration Certifcate" type="file" />
                    <x-form.element.input1 name="gst_number" label="GST Number" required="required" />
                    <x-form.element.input1 name="gst_certificate" label="GST Certifcate" type="file" required="required" />
                    <x-form.element.input1 name="email" label="Business Email" type="email" />
                    <x-form.element.input1 name="phone" label="Business Phone" />
                    <x-form.element.input1 name="address" label="Address" required="required" />
                    <x-form.element.input1 name="city" label="City" required="required" />
                    <x-form.element.input1 name="pin" label="Pin Code" type="number" required="required" />
                    <x-form.element.input1 name="state_id" label="State" type="select" :options="$states" value="3" required="required" />
                    <x-form.element.input1 name="subscription_type_id" label="Subscription Type" type="select" :options="$subscription_types" value="1" required="required" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Owner Detail">
                    <x-form.element.input1 name="owner_name" label="Owner Name" required="required" />
                    <x-form.element.input1 name="owner_profile_pic" label="Owner Photo" type="file" />
                    <x-form.element.input1 name="owner_phone" label="Phone Number" required="required" />
                    <x-form.element.input1 name="owner_email" label="Email ID" type="email" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Bank Detail">
                    <x-form.element.input1 name="bank_account_number" label="Account Number" />
                    <x-form.element.input1 name="bank_account_holder_name" label="Account Holder Name" />
                    <x-form.element.input1 name="bank_ifsc" label="IFSC" />
                    <x-form.element.input1 name="bank_swift" label="Swift" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Other Detail">
                    <x-form.element.input1 name="iec_code" label="IEC Code" />
                    <x-form.element.input1 name="ad_code" label="AD Code" />
                    <x-form.element.input1 name="arn_code" label="ARN Code" />
                    <x-form.element.input1 name="payment_terms" label="Payment Term" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.partner.app>
