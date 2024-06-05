<tfoot {{ $attributes->merge(["class"=>""]) }}>
    <x-table.element.tr>
        <x-table.element.td colspan="{{ $colspan }}">
            {{ $data2->links() }}
        </x-table.element.td>
    </x-table.element.tr>
</tfoot>