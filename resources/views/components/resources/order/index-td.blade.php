<x-table.element.td :data="$data2['invoice_number']" />
<x-table.element.td :data="App\Helpers\Helper::customDate($data2['created_at'])" />
<x-table.element.td :data="$data2['customer_name']" />
<x-table.element.td>
    {{ App\Helpers\Helper::customMoneyFormat($data2['products_sum_amount']) }}
</x-table.element.td>
<x-table.element.td class="text-center">
    <a href="{{ route('invoice.generate', [$data2['id'], 'original']) }}" target="_blank" class="px-2 text-primary"> <i
            class="fa fa-download"></i> </a>
    <a href="{{ route('invoice.generate', [$data2['id'], 'duplicate']) }}" target="_blank" class="px-2 text-secondary"> <i
            class="fa fa-download"></i> </a>
</x-table.element.td>
<x-table.element.td>
    <a href="{{ route('order.show', $data2['id']) }}">
        <i class="fas fa-eye"></i>
    </a>
</x-table.element.td>
