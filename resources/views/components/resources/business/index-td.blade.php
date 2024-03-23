<x-table.element.td>
    <img src="{{ asset($data2['logo']) }}" alt="" width="64px">
</x-table.element.td>
<x-table.element.td :data="$data2['name']" />
<x-table.element.td :data="$data2['owner_name']" />
<x-table.element.td :data="$data2['city']" />
<x-table.element.td :data="$data2['created_at']" />
