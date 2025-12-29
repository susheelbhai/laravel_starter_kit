<x-layout.admin.app>
    <x-slot name="head">
        <title> View Product Category | {{ config('app.name') }}</title>
    </x-slot>


    <x-table.type.responsive title="View Product Category Detail">
        <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Title"/>
                <x-table.element.td :data="$data->title"/>
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Title"/>
                    <x-table.element.td :data="$data['title']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Slug"/>
                    <x-table.element.td :data="$data['slug']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Description"/>
                    <x-table.element.td :data="$data['description']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Position"/>
                    <x-table.element.td :data="$data['position']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Title"/>
                    <x-table.element.td :data="$data['meta_title']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Description"/>
                    <x-table.element.td :data="$data['meta_description']"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Icon"/>
                    <x-table.element.td>
                        <img src="{{ $data['icon_thumb'] ?? '' }}" width="120px">
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status"/>
                    <x-table.element.td :data="($data['is_active']) ? 'Active' : 'Not Active'"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Featured"/>
                    <x-table.element.td :data="($data['is_featured']) ? 'Yes' : 'No'"/>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="col-12 py-3">
                            <a href="{{ route('admin.product_category.edit', $data['id']) }}" type="button" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                                <span class="btn-icon-end"> Edit Detail </span>
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
                <x-table.element.th data="Ad URL"/>
