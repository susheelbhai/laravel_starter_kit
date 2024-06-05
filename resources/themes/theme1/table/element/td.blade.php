<td colspan="{{ $colspan }}" {{ $attributes->merge(["class"=>""]) }}>
    {{ $data2 ?? '' }}
    {{ $slot }}
</td>