<x-table.type.paginate title="User Query" :data="$data">
    <x-table.element.thead>
        <x-table.element.tr>
            <x-table.element.th data="Name" />
            <x-table.element.th data="Email" />
            <x-table.element.th data="Phone" />
            <x-table.element.th data="Subject" />
            <x-table.element.th data="Status" />
            <x-table.element.th data="Action" />
        </x-table.element.tr>
    </x-table.element.thead>

    <x-table.element.tbody>
        @forelse ($data as $i)
            <x-table.element.tr>
                <x-table.element.td :data="$i['name']" />
                <x-table.element.td :data="$i['email']" />
                <x-table.element.td :data="$i['phone']" />
                <x-table.element.td :data="$i['subject']" />
                <x-table.element.td>
                    @if ($i['status_id'] == 1)
                        <x-ui.badge :title="$i['status']['name']" type="info" />
                    @elseif ($i['status_id'] == 2)
                        <x-ui.badge :title="$i['status']['name']" type="success"/>
                    @elseif ($i['status_id'] == 3)
                        <x-ui.badge :title="$i['status']['name']" type="danger"/>
                    @elseif ($i['status_id'] == 4)
                        <x-ui.badge :title="$i['status']['name']" type="primary"/>
                    @elseif ($i['status_id'] == 5)
                        <x-ui.badge :title="$i['status']['name']" type="primary"/>
                    @endif 
                </x-table.element.td>
                <x-table.element.td>
                    <a href="{{ route('admin.userQuery.show', $i->id) }}"> <i class="fa fa-eye"></i> </a> 
                </x-table.element.td>
            </x-table.element.tr>
        @empty
            <x-table.element.tr>
                <x-table.element.td colspan="6" data="No Data Found" />
            </x-table.element.tr>
        @endforelse
        
    </x-table.element.tbody>

</x-table.type.paginate>