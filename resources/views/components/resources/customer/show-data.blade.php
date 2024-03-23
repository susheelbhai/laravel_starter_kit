<x-table.element.tr>
    <x-table.element.th data="Customer Name" />Owner
    <x-table.element.td :data="$data2['name']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer GSTIN" />
    <x-table.element.td :data="$data2['gstin']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer Email" />
    <x-table.element.td :data="$data2['email']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer Phone" />
    <x-table.element.td :data="$data2['phone']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer Address" />
    <x-table.element.td :data="$data2['address']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer City" />
    <x-table.element.td :data="$data2['city']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer Pin" />
    <x-table.element.td :data="$data2['pin']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Customer State" />
    <x-table.element.td :data="$data2['state']['name']" />
</x-table.element.tr>