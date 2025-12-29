<x-layout.admin.app>
    <x-slot name="head">
        <title> All Product Category | {{ config('app.name') }}</title>
    </x-slot>

    <x-table.type.responsive title="All Blogs" :addUrl="route('admin.product_category.create')" >
        <x-table.element.thead>
            <x-table.element.tr>
                <x-table.element.th data="Title" />
                <x-table.element.th data="Slug" />
                <x-table.element.th data="Description" />
                <x-table.element.th data="Icon" />
                <x-table.element.th data="Banner" />
                <x-table.element.th data="Status" />
                <x-table.element.th data="Featured" />
                <x-table.element.th data="Action" />
            </x-table.element.tr>
        </x-table.element.thead>

        <x-table.element.tbody>
            @forelse ($data as $i)
                <x-table.element.tr>
                    <x-table.element.td :data="$i['title']" />
                    <x-table.element.td :data="$i['slug']" />
                    <x-table.element.td :data="$i['description']" />
                    <x-table.element.td>
                        <img src="{{ $i['icon_thumb'] ?? '' }}" width="30px" alt="">
                    </x-table.element.td>
                    <x-table.element.td>
                        <img src="{{ $i['banner_thumb'] ?? '' }}" width="30px" alt="">
                    </x-table.element.td>
                    <x-table.element.td>
                        @if ($i['is_active'] == 1)
                            <x-ui.badge title="Active" type="primary"/>
                        @else
                            <x-ui.badge title="Not Active" type="danger"/>
                        @endif
                    </x-table.element.td>
                    <x-table.element.td>
                        @if ($i['is_featured'] == 1)
                            <x-ui.badge title="Yes" type="primary"/>
                        @else
                            <x-ui.badge title="No" type="secondary"/>
                        @endif
                    </x-table.element.td>
                    <x-table.element.td>
                        <a href="{{ route('admin.product_category.show', $i['id']) }}"> <i class="fa fa-eye"></i> </a> 
                    </x-table.element.td>
                </x-table.element.tr>
            @empty
                <x-table.element.tr>
                    <x-table.element.td colspan="8" data="No Data Found" />
                </x-table.element.tr>
            @endforelse
        </x-table.element.tbody>

    </x-table.type.responsive>

</x-admin.a-layout>