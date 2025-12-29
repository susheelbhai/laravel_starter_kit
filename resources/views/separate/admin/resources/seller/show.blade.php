<x-layout.admin.app>
    <x-slot name="head">
        <title> View Seller | {{ config('app.name') }}</title>
    </x-slot>

    <x-table.type.responsive title="View seller Detail">

        <x-table.element.tbody>
            <x-table.element.tr>
                <x-table.element.th data="Name"/>
                <x-table.element.td :data="$data->name"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Email"/>
                <x-table.element.td :data="$data->email"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Phone"/>
                <x-table.element.td :data="$data->phone"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ asset('images/profile_pic/seller/'.$data['profile_pic']) }}" width="60px">
                </x-table.element.td>
            </x-table.element.tr>
                
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="col-12 py-3">
                        <a href="{{ route('admin.seller.edit', $data['id']) }}" type="button" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            <span class="btn-icon-end"> Edit Detail </span>
                        </a>
                    </div>
                </x-table.element.td>
            </x-table.element.tr>

        </x-table.element.tbody>

    </x-table.type.responsive>

</x-layout.admin.app>
