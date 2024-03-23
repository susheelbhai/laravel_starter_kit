<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> All Order | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Add Money {{ Helper::customCurrencyFormat($data->sum('amount')) }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaction.store') }}" method="post">
                                @csrf
                                <x-form.element.input1 name="order_id" type="hidden" value="ffikjh" />
                                <x-form.element.input1 name="amount" label="Amount in Rupees" required="required" div="1" placeholder="₹ " />
                                <x-form.element.button1 name="button" type="submit" title="Checkout" div=1 />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <x-table.type.responsive title="All Payments">

                <x-table.element.thead>
                    <x-table.element.tr>
                            <x-table.element.th data="Date" />
                            <x-table.element.th data="Amount" />
                            <x-table.element.th data="Gst" />
                            <x-table.element.th data="Total" />
                            <x-table.element.th data="Invoice" />
                    </x-table.element.tr>
                </x-table.element.thead>

                <x-table.element.tbody>
                    @forelse ($payments as $i)
                        <x-table.element.tr>
                            <x-table.element.td :data="Helper::customDate($i['created_at'])" />
                            <x-table.element.td :data="$i['amount']/(1+0.01*$i['gst_percentage'])" />
                            <x-table.element.td :data="$i['gst_percentage']" />
                            <x-table.element.td :data="$i['amount']" />
                            <x-table.element.td>
                                <a href="{{ route('create_payment_invoice', $i['id']) }}" target="_blank">
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

            </x-table.type.responsive>
            <x-table.type.responsive title="All Transaction">

                <x-table.element.thead>
                    <x-table.element.tr>
                            <x-table.element.th data="Date" />
                            <x-table.element.th data="Amount" />
                            <x-table.element.th data="Transaction Type" />
                            <x-table.element.th data="Remarks" />
                    </x-table.element.tr>
                </x-table.element.thead>

                <x-table.element.tbody>
                    @forelse ($data as $i)
                        <x-table.element.tr>
                            <x-table.element.td :data="Helper::customDate($i['created_at'])" />
                            @if ($i['amount']>0)
                                <x-table.element.td>
                                    <span class="text-success"> + {{ $i['amount'] }} </span>
                                </x-table.element.td>
                            @else
                                <x-table.element.td>
                                    <span class="text-danger"> {{ $i['amount'] }} </span>
                                </x-table.element.td>
                            @endif
                            
                            <x-table.element.td :data="$i['transactionType']['name'] ?? ''" />
                            <x-table.element.td :data="$i['remarks']" />
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
</x-layout.user.app>
