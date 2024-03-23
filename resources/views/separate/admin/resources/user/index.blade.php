<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> All Users | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            <x-table.type.responsive title="User Data">

                <x-table.element.thead>
                    <x-table.element.tr>
                        <x-table.element.th data="Name" />
                        <x-table.element.th data="Email" />
                        <x-table.element.th data="Phone" />
                        <x-table.element.th data="Business" />
                        <x-table.element.th data="Designation" />
                        <x-table.element.th data="Action" />
                    </x-table.element.tr>
                </x-table.element.thead>

                <x-table.element.tbody>
                    @forelse ($data as $i)
                        <x-table.element.tr>
                            <x-table.element.td :data="$i['name']" />
                            <x-table.element.td :data="$i['email']" />
                            <x-table.element.td :data="$i['phone']" />
                            <x-table.element.td :data="$i['phone']" />
                            <x-table.element.td :data="$i['designation']" />
                            <x-table.element.td :data="$i['designation']" />
                        </x-table.element.tr>
                    @empty
                        <x-table.element.tr>
                            <x-table.element.td colspan="6" data="No Data Found" />
                        </x-table.element.tr>
                    @endforelse
                    
                </x-table.element.tbody>

            </x-table.type.responsive>
        </div>
    </section>
</x-layout.admin.app>
