<x-admin-layout>


    <x-admin.table.table1 heading="All Business" :addUrl="route('admin.category.create')"  >

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Icon</th>
                <th> Status </th>
                <th> View </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($data as $key => $i)
            <tr>
                <th scope="row">{{ $i->id }}</th>
                <td>{{ $i->name }}</td>
                <td> <i class="{{ $i->icon }}"></i> </td>
                @if ($i->is_active == 1)
                <td> Active </td>
                @else
                <td> Not Active </td>
                @endif
                <td> <a href="{{ route('admin.category.show', $i->id) }}"> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>
    </x-admin.table.table1>

</x-admin-layout>