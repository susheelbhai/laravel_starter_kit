<x-admin.app-layout>


    <x-admin.table.table1 heading="All Queries">

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Email</th>
                <th> Phone </th>
                <th> Message </th>
                <th> View </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($data as $index => $i)
            <tr>
                <th scope="row">{{ $index + $data->firstItem() }}</th>
                <td>{{ $i->name }}</td>
                <td>{{ $i->email }}</td>
                <td>{{ $i->phone }}</td>
                <td>{{ $i->description }}</td>
                <td> <a href=""> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>

        <x-slot name="paginate"> {{ $data->links(); }} </x-slot>
    </x-admin.table.table1>

</x-admin.app-layout>