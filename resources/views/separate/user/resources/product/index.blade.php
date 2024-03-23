<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> All Product | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            
            <x-table.type.datatable title="All Product" :add-url="route('product.create')">

                <x-table.element.thead>
                    <x-table.element.tr>
                        <x-resources.product.index-th />
                        <x-table.element.th data="Action" />
                    </x-table.element.tr>
                </x-table.element.thead>

                <x-table.element.tbody>
                    @forelse ($data as $i)
                        <x-table.element.tr>
                            <x-resources.product.index-td :data="$i" />
                            <x-table.element.td>
                                <a href="{{ route('product.show', $i['id']) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </x-table.element.td>
                        </x-table.element.tr>
                    @empty
                        <x-table.element.tr>
                            <x-table.element.td colspan="6" data="No Data Found" />
                        </x-table.element.tr>
                    @endforelse

                </x-table.element.tbody>

            </x-table.type.datatable>
        </div>
    </section>
</x-layout.user.app>
