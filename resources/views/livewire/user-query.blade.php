<x-table.type.responsive title="User Data">
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
                <x-table.element.td :data="$i['status']['name']" />
                <x-table.element.td>
                    <a href="{{ route('admin.userQuery.show', $i->id) }}"> <i class="fa fa-eye"></i> </a> 
                </x-table.element.td>
            </x-table.element.tr>
        @empty
            <x-table.element.tr>
                <x-table.element.td colspan="6" data="No Data Found" />
            </x-table.element.tr>
        @endforelse
        <tr>
            <td colspan="6"> {{ $data->links() }} </td>
        </tr>
    </x-table.element.tbody>

</x-table.type.responsive>