<div class="row">
    @if ($addUrl != '#')
    <x-form.element.button1 :href="$addUrl" title="Add New" type="add" div="4" />
    @endif
    
    <div class="col-lg-12">
        <div class="card">
            <div class="cardhead">
                <div class="card-header">
                    <h5 class="card-title">{{ $title }}</h5>
                    {{ $status ?? '' }}
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        {{ $slot }}
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
