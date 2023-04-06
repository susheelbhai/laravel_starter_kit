<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Home Page Settings | {{ Config::get('settings', 'default')->app_name }}</title>
    </x-slot>


    <x-admin.table.table1 heading="Banner Slider" :addUrl="route('admin.slider1.create')">

        <x-slot name="thead">
            <tr>
                <th>#</th>
                <th> Heading 1</th>
                <th> Heading 2</th>
                <th> Image 1</th>
                <th> Image 2</th>
                <th> Status </th>
                <th> Edit </th>
            </tr>
        </x-slot>

        <x-slot name="tbody">
            @foreach ($slider1 as $index => $i)
            <tr>
                <th scope="row">{{ $index+1 }}</th>
                <td>{{ $i->heading1 }}</td>
                <td>{{ $i->heading2 }}</td>
                <td> <img src="{{ asset('storage/images/webpages/banners/' . $i->image1) }}" width="120px" alt=""> </td>
                <td> <img src="{{ asset('storage/images/webpages/banners/' . $i->image2) }}" width="120px" alt=""> </td>
                <td>{{ $i->status }}</td>
                <td> <a href="{{ route('admin.slider1.edit',$i->id) }}"> <i class="fas fa-edit"></i> </a> </td>
            </tr>
            @endforeach
            
        </x-slot>

    </x-admin.table.table1>

</x-admin.app-layout>