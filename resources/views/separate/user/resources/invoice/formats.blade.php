<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Invoice Settings | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($all_formats as $i)
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                {{ $i->name }}
                                @if ($data['business_id'] == $i->id)
                                    <div class="text-success">Default</div>
                                @endif
                            </div>
                            <div class="card-body">
                                Sapmle 1 : {{ $i->sample1 }} <br>
                                Sapmle 2 : {{ $i->sample2 }} <br>
                                Sapmle 3 : {{ $i->sample3 }} <br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout.user.app>
