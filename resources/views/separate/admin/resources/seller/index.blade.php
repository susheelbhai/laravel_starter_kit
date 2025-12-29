<x-layout.admin.app>
    <x-slot name="head">
        <title> All Seller  | {{ config('app.name') }}</title>
    </x-slot>

    <x-table.type.responsive title="Seller Data" :addUrl="route('admin.seller.create')" >
        <x-table.element.thead>
            <x-table.element.tr>
                <x-table.element.th data="Name" />
                <x-table.element.th data="Email" />
                <x-table.element.th data="Phone" />
                <x-table.element.th data="Photo" />
                <x-table.element.th data="Action" />
            </x-table.element.tr>
        </x-table.element.thead>

        <x-table.element.tbody>
            @forelse ($data as $i)
                <x-table.element.tr>
                    <x-table.element.td :data="$i['name']" />
                    <x-table.element.td :data="$i['email']" />
                    <x-table.element.td :data="$i['phone']" />
                    <x-table.element.td>
                        <img src="{{$i['profile_pic_thumb'] }}" width="30px" >
                    </x-table.element.td>
                    <x-table.element.td>
                        <a href="{{ route('admin.seller.show', $i['id']) }}"> <i class="fa fa-eye"></i> </a> 
                    </x-table.element.td>
                </x-table.element.tr>
            @empty
                <x-table.element.tr>
                    <x-table.element.td colspan="6" data="No Data Found" />
                </x-table.element.tr>
            @endforelse
            
        </x-table.element.tbody>

    </x-table.type.responsive>


</x-layout.admin.app>