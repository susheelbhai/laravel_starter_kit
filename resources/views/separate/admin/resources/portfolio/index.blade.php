<x-layout.admin.app>
    <x-slot name="head">
        <title> All Portfolio | {{ config('app.name') }}</title>
    </x-slot>

    <x-table.type.responsive title="All Portfolios" :addUrl="route('admin.portfolio.create')" >
        {{-- {{ Auth::guard('admin')->user() }} --}}
        <x-table.element.thead>
            <x-table.element.tr>
                <x-table.element.th data="Name" />
                <x-table.element.th data="Url" />
                <x-table.element.th data="Logo" />
                <x-table.element.th data="Status" />
                <x-table.element.th data="Action" />
            </x-table.element.tr>
        </x-table.element.thead>

        <x-table.element.tbody>
            @forelse ($data as $i)
                <x-table.element.tr>
                    <x-table.element.td :data="$i['name']" />
                    <x-table.element.td :data="$i['url']" />
                    <x-table.element.td >
                        <img src="{{ asset($i->logo) }}" width="80px" alt="">
                    </x-table.element.td>
                    <x-table.element.td>
                        @if ($i->is_active == 1)
                        Active
                        @else
                        Not Active
                        @endif
                    </x-table.element.td>
                    <x-table.element.td>
                        <a href="{{ route('admin.portfolio.show', $i->id) }}"> <i class="fa fa-eye"></i> </a> 
                    </x-table.element.td>
                </x-table.element.tr>
            @empty
                <x-table.element.tr>
                    <x-table.element.td colspan="6" data="No Data Found" />
                </x-table.element.tr>
            @endforelse
            
        </x-table.element.tbody>

    </x-table.type.responsive>

</x-admin.a-layout>