
<x-admin.app-layout>
    
  <x-slot name="head_tag">
      <title> General Settings </title>
  </x-slot>

  <x-admin.dashboard.heading1 heading="Setting" />


  <div class="container-fluid">
    <div class="row">
      <div class="col col-md-12 col-lg-12 col-xl-8">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">General Settings</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" action="{{ route('admin.settings.general') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12">
                  <!-- text input -->
                  <div class="form-group">
    
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                         <x-admin.form.input1 type="text" name="app_name" lbl="App Name" value="{{$settings->app_name}}" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <x-admin.form.input-img1 name="favicon" lbl=" Change Favicon" :value="asset('storage/images/webpages/logo/' . $settings->favicon)" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row pt-4">
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <x-admin.form.input-img1 name="dark_logo" lbl=" Change dark Logo" :value="asset('storage/images/webpages/logo/' . $settings->dark_logo)" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <x-admin.form.input-img1 name="light_logo" lbl=" Change Light Logo" :value="asset('storage/images/webpages/logo/' . $settings->light_logo)" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
    
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                         <x-admin.form.input1 type="color" name="color1" lbl="Theme Color 1" value="{{$settings->color1}}" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <x-admin.form.input1 type="color" name="color2" lbl="Theme Color 2" value="{{$settings->color2}}" />
                     </div>
                    </div>
                  </div>
    
                  <button type="submit" class="btn btn-primary w-100 mt-4" > Submit </button>
                </div>
    
              </div>
    
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
    
      </div>
    </div>
  </div>
</x-admin.app-layout>
