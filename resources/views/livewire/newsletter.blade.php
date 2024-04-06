<x-table.type.paginate title="Newsletter" :data="$data">
    <x-table.element.thead>
        <x-table.element.tr>
            <x-table.element.th data="Subscrib at" />
            <x-table.element.th data="Email" />
            <x-table.element.th data="Status" />
        </x-table.element.tr>
    </x-table.element.thead>

    <x-table.element.tbody>
        @forelse ($data as $i)
            <x-table.element.tr>
                <x-table.element.td :data="$i['created_at']" />
                <x-table.element.td :data="$i['email']" />
                <x-table.element.td>
                    @if ($i['unsubscribed_at'] == null)
                        <x-ui.badge title="active" />
                    @else
                        <x-ui.badge title="not active" type="danger"/>
                    @endif 
                </x-table.element.td>
            </x-table.element.tr>
        @empty
            <x-table.element.tr>
                <x-table.element.td colspan="6" data="No Data Found" />
            </x-table.element.tr>
        @endforelse
    </x-table.element.tbody>

</x-table.type.paginate>