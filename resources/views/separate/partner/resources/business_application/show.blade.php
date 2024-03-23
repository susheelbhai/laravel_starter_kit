<x-layout.partner.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Show Application Detail | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            <x-table.type.responsive title="Business Application Detail">
                <x-slot name="status">
                    @if ($data['approved_at'] != null)
                        <x-ui.badge-light title="Approved" type="success" size="xl" />
                    @elseif($data['rejected_at'] != null)
                        <x-ui.badge-light title="Rejected" type="danger" size="xl" />
                    @else
                        <x-ui.badge-light title="Pending for approval" type="warning" size="xl" />
                    @endif
                </x-slot>

                <x-table.element.tbody>
                    <x-resources.business-application.show-business-data :data="$data" />
                    <x-resources.business-application.show-owner-data :data="$data" />
                    <x-resources.business-application.show-bank-data :data="$data" />
                    
                    
                    @if ($data['approved_at'] == null && $data['rejected_at'] == null)
                        <x-table.element.tr>
                            <x-table.element.td colspan="2">
                                <div class="col-12 py-3">
                                    <a href="{{ route('partner.business_application.edit', $data['id']) }}"
                                        type="button" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                        <span class="btn-icon-end"> Edit Detail </span>
                                    </a>
                                </div>
                            </x-table.element.td>
                        </x-table.element.tr>
                    @endif

                </x-table.element.tbody>

            </x-table.type.responsive>

        </div>
    </section>
</x-layout.partner.app>
