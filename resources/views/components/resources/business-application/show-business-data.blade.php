<x-table.element.tr>
    <x-table.element.th data="Subscription Type" />
    <x-table.element.td :data="$data2['subscriptionType']['name'] ?? ''" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Logo" />
    <x-table.element.td>
        <img src="{{ asset($data2['logo']) }}" alt="" width="64px">
    </x-table.element.td>
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Authorised Signature" />
    <x-table.element.td>
        <img src="{{ asset($data2['authorised_sign']) }}" alt="" width="64px">
    </x-table.element.td>
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Authorised Stamp" />
    <x-table.element.td>
        <img src="{{ asset($data2['authorised_stamp']) }}" alt="" width="64px">
    </x-table.element.td>
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Applied Date" />
    <x-table.element.td :data="$data2['created_at']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Name" />
    <x-table.element.td :data="$data2['name']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Email" />
    <x-table.element.td :data="$data2['email']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Phone" />
    <x-table.element.td :data="$data2['phone']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Address" />
    <x-table.element.td :data="$data2['address']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business City" />
    <x-table.element.td :data="$data2['city']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business Pin" />
    <x-table.element.td :data="$data2['pin']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Business State" />
    <x-table.element.td :data="$data2['state']['name']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Registration Number" />
    <x-table.element.td :data="$data2['registration_number']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Registration Certificate" />
    <x-table.element.td>
        <a href="{{ asset($data2['registration_certificate']) }}" target="_blank">View</a>
    </x-table.element.td>
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="GST Number" />
    <x-table.element.td :data="$data2['gst_number']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="GST Certificate" />
    <x-table.element.td>
        <a href="{{ asset($data2['gst_certificate']) }}" target="_blank">View</a>
    </x-table.element.td>
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="IEC Code" />
    <x-table.element.td :data="$data2['iec_code']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="AD Code" />
    <x-table.element.td :data="$data2['ad_code']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="ARN Code" />
    <x-table.element.td :data="$data2['arn_code']" />
</x-table.element.tr>