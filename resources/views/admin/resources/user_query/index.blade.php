<x-admin.app-layout>


    <x-admin.table.table1 heading="All Queries">

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Name</th>
                <th> Email</th>
                <th> Phone </th>
                <th> Subject </th>
                <th> Status </th>
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
                <td>{{ $i->subject }}</td>
                <td>{{ $i['status']->name }}</td>
                <td> <a href="{{ route('admin.userQuery.show', $i->id) }}"> <i class="fas fa-eye"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>

        <x-slot name="paginate"> {{ $data->links(); }} </x-slot>
    </x-admin.table.table1>

</x-admin.app-layout>