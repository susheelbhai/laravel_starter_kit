<x-layout.admin.app>
    <x-slot name="head">
        <title> View Testimonial | {{ config('app.name') }}</title>
    </x-slot>


    <x-table.type.responsive title="View partner Detail">
        <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Name"/>
                <x-table.element.td :data="$data->name"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="designation"/>
                <x-table.element.td :data="$data->designation"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="organisation"/>
                <x-table.element.td :data="$data->organisation"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ asset('images/testimonials/').'/'.$data->image }}" width="120px">
                </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="message"/>
                <x-table.element.td :data="$data->message"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status"/>
                <x-table.element.td :data="($data->is_active) ? 'Active' : 'Not Active'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="col-12 py-3">
                        <a href="{{ route('admin.testimonial.edit', $data['id']) }}" type="button" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            <span class="btn-icon-end"> Edit Detail </span>
                        </a>
                    </div>
                </x-table.element.td>
            </x-table.element.tr>

        </x-table.element.tbody>
    </x-table.type.responsive>

</x-admin-layout>
