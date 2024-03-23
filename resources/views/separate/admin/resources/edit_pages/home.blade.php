<x-layout.admin.app>

    <x-slot name="head">
        <title> Home Page Edit | {{ config('app.name', 'default') }}</title>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title table_heading">Banner Slider</h4>
            <span> Dimension : 1738 X 720</span>
            <div class="right_div">
                <a class="btn btn-primary" href="{{ route('admin.slider1.create') }}"> Add New </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($slider1 as $index => $i)
                    <div class="col col-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/slider/' . $i->image1) }}" alt="Card image cap">
                            <div class="card-body">
                                
                                <div>{{ $i->status }}</div>
                                <div> <a href="{{ route('admin.slider1.edit', $i->id) }}"> Edit <i
                                            class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>



</x-layout.admin.app>