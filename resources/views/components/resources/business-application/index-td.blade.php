<x-table.element.td :data="$data2['created_at']" />
<x-table.element.td>
    <img src="{{ asset($data2['logo']) }}" alt="" width="64px">
</x-table.element.td>
<x-table.element.td :data="$data2['name']" />
<x-table.element.td :data="$data2['owner_name']" />
<x-table.element.td :data="$data2['city']" />
<x-table.element.td>
    @if ($data2['approved_at'] != null)
        <x-ui.badge title="Approved" type="success" size="sm" />
    @elseif($data2['rejected_at'] != null)
        <x-ui.badge title="Rejected" type="danger" size="sm" />
    @else
        <x-ui.badge title="Pending for approval" type="warning" size="sm" />
    @endif
</x-table.element.td>
