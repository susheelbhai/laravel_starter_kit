<x-layout.admin.app>
    <x-slot name="head">
        <title> View Service | {{ config('app.name') }}</title>
    </x-slot>


    <x-table.type.responsive title="View Service Detail">
        <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Title"/>
                <x-table.element.td :data="$data->title"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Category"/>
                <x-table.element.td :data="$data->category"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Short Description"/>
                <x-table.element.td :data="$data->short_description"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 1"/>
                <x-table.element.td > {!! $data->long_description1 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 2"/>
                <x-table.element.td > {!! $data->long_description2 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 3"/>
                <x-table.element.td > {!! $data->long_description3 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ asset($data->display_img) }}" width="120px">
                </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status"/>
                <x-table.element.td :data="($data->is_active) ? 'Active' : 'Not Active'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="col-12 py-3">
                        <a href="{{ route('admin.service.edit', $data['id']) }}" type="button" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            <span class="btn-icon-end"> Edit Detail </span>
                        </a>
                    </div>
                </x-table.element.td>
            </x-table.element.tr>

        </x-table.element.tbody>
    </x-table.type.responsive>

</x-admin-layout>
