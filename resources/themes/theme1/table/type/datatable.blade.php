
<div class="row">
    
    <x-form.element.button1 :href="$addUrl" title="Add New" type="add" div="4" />

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $title }} </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        {{ $slot }}
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

