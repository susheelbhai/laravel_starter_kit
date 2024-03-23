<x-layout.partner.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Business Application | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <x-form.type.standard title="Edit Business Application" action="{{ route('partner.business_application.update', $data['id']) }}">
                @method('patch')
                <x-form.element.form-group title="Business Detail">
                    <x-form.element.input1 name="name" :value="$data['name']" label="Business Name" required="required" />
                    <x-form.element.input1 name="logo" :value="$data['logo']" label="Business Logo" type="file" />
                    <x-form.element.input1 name="registration_number" :value="$data['registration_number']" label="Registration Number" />
                    <x-form.element.input1 name="registration_certificate" :value="$data['registration_certificate']" label="Registration Certifcate" type="file" />
                    <x-form.element.input1 name="gst_number" :value="$data['gst_number']" label="GST Number" required="required" />
                    <x-form.element.input1 name="gst_certificate" :value="$data['gst_certificate']" label="GST Certifcate" type="file" />
                    <x-form.element.input1 name="email" :value="$data['email']" label="Business Email" type="email" />
                    <x-form.element.input1 name="phone" :value="$data['phone']" label="Business Phone" />
                    <x-form.element.input1 name="address" :value="$data['address']" label="Address" required="required" />
                    <x-form.element.input1 name="city" :value="$data['city']" label="City" required="required" />
                    <x-form.element.input1 name="pin" :value="$data['pin']" label="Pin Code" type="number" required="required" />
                    <x-form.element.input1 name="state_id" :value="$data['state_id']" label="State" type="select" :options="$states" value="3" required="required" />
                    <x-form.element.input1 name="subscription_type_id" label="Subscription Type" type="select" :options="$subscription_types" :value="$data['subscription_type_id']" required="required" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Owner Detail">
                    <x-form.element.input1 name="owner_name" :value="$data['owner_name']" label="Owner Name" required="required" />
                    <x-form.element.input1 name="owner_profile_pic" :value="$data['owner_profile_pic']" label="Owner Photo" type="file" />
                    <x-form.element.input1 name="owner_phone" :value="$data['owner_phone']" label="Phone Number" required="required" />
                    <x-form.element.input1 name="owner_email" :value="$data['owner_email']" label="Email ID" type="email" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Bank Detail">
                    <x-form.element.input1 name="bank_account_number" :value="$data['bank_account_number']" label="Account Number" />
                    <x-form.element.input1 name="bank_account_holder_name" :value="$data['bank_account_holder_name']" label="Account Holder Name" />
                    <x-form.element.input1 name="bank_ifsc" :value="$data['bank_ifsc']" label="IFSC" />
                    <x-form.element.input1 name="bank_swift" :value="$data['bank_swift']" label="Swift" />
                    <x-form.element.input1 name="ifsc" :value="$data['ifsc']" label="IFSC Code" />
                </x-form.element.form-group>
                
                <x-form.element.form-group title="Other Detail">
                    <x-form.element.input1 name="iec_code" :value="$data['iec_code']" label="IEC Code" />
                    <x-form.element.input1 name="ad_code" :value="$data['ad_code']" label="AD Code" />
                    <x-form.element.input1 name="arn_code" :value="$data['arn_code']" label="ARN Code" />
                    <x-form.element.input1 name="payment_terms" :value="$data['payment_terms']" label="Payment Term" />
                </x-form.element.form-group>
                
            </x-form.type.standard>

        </div>
    </section>
</x-layout.partner.app>
