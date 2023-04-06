<x-admin.app-layout>
    <x-slot name="head">
        <title> Admin Dashboard | {{ Config::get('settings')->app_name }}</title>
    </x-slot>
    
    <div class="container-fluid">
        <x-admin.dashboard.heading1 heading="Dashboard" />

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <x-admin.dashboard.card1 heading='Total Sales' icon='ri-shopping-cart-2-line' data1='122'
                    data2=''>
                    <p class="text-muted mb-0">
                        <span class="text-success fw-bold font-size-12 me-2">
                            <i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%
                        </span>
                        from previous period
                    </p>
                </x-admin.dashboard.card1>
            </div>
            <div class="col-xl-3 col-md-6">
                <x-admin.dashboard.card1 heading='Total Sales' icon='ri-shopping-cart-2-line' data1='122'
                    data2=''>
                    <p class="text-muted mb-0">
                        <span class="text-success fw-bold font-size-12 me-2">
                            <i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%
                        </span>
                        from previous period
                    </p>
                </x-admin.dashboard.card1>
            </div>
            <div class="col-xl-3 col-md-6">
                <x-admin.dashboard.card1 heading='Total Sales' icon='ri-shopping-cart-2-line' data1='122'
                    data2=''>
                    <p class="text-muted mb-0">
                        <span class="text-success fw-bold font-size-12 me-2">
                            <i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%
                        </span>
                        from previous period
                    </p>
                </x-admin.dashboard.card1>
            </div>
            <div class="col-xl-3 col-md-6">
                <x-admin.dashboard.card1 heading='Total Sales' icon='ri-shopping-cart-2-line' data1='122'
                    data2=''>
                    <p class="text-muted mb-0">
                        <span class="text-success fw-bold font-size-12 me-2">
                            <i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%
                        </span>
                        from previous period
                    </p>
                </x-admin.dashboard.card1>
            </div>
        </div>
        
    </div>

</x-admin-layout>
