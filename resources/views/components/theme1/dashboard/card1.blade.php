<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">{{ $heading }}</p>
                <h4 class="mb-2">{{ $data1 }}</h4>
                {{ $slot }}
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-primary rounded-3">
                    <i class="{{ $icon }} font-size-24"></i>  
                </span>
            </div>
        </div>                                            
    </div>
</div>