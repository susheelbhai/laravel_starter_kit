<x-table.element.tr>
    <x-table.element.th data="Owner Name" />
    <x-table.element.td :data="$data2['owner_name']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Owner Email" />
    <x-table.element.td :data="$data2['owner_email']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Owner Phone" />
    <x-table.element.td :data="$data2['owner_phone']" />
</x-table.element.tr>
<x-table.element.tr>
    <x-table.element.th data="Owner Photo" />
    <x-table.element.td>
        <img src="{{ asset($data2['owner_photo']) }}" alt="" width="64px">
    </x-table.element.td>
</x-table.element.tr>