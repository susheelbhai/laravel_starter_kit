<x-admin.app-layout>


    <x-admin.table.table1 heading="All Partner">

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Email</th>
                <th> Phone </th>
                <th> View </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($data as $i)
            <tr>
                <th scope="row">1</th>
                <td>{{ $i->name }}</td>
                <td>{{ $i->email }}</td>
                <td>{{ $i->phone }}</td>
                <td> <a href="{{ route('admin.partner.show', $i->partner_id) }}"> <i class="fa fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>
    </x-admin.table.table1>

</x-admin.app-layout>