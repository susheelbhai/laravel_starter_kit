


<x-admin.app-layout>
    
    <x-slot name="head">
        <title> Advanced Settings | {{ $settings->app_name }}</title>
    </x-slot>
    <x-admin.dashboard.heading1 heading="Setting" />


    <div class="container-fluid">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Advance Settings</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form method="post" action="{{ route('admin.settings.advanced') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <x-admin.form.input1 type="textarea" name="short_description" />
                <!-- text input -->
                <div class="form-group">
                  <label>Short Description</label>
                  <textarea name="short_description" class="form-control" rows="6" placeholder="Enter ..."> {{$settings->short_description}} </textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Address</label>
                  <textarea name="address" class="form-control" rows="6" placeholder="Enter ..."> {{$settings->address}} </textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Contact Number</label>
                  <input name="phone" type="text" class="form-control" placeholder="Enter ..." value="{{$settings->phone}}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control" placeholder="Enter ..." value="{{$settings->email}}">
                </div>
              </div>
            </div>
      
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Facebook</label>
                  <input name="facebook" type="text" class="form-control" placeholder="Enter ..." value="{{$settings->facebook}}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Instagram</label>
                  <input name="instagram" type="text" class="form-control" placeholder="Enter ..." value="{{$settings->instagram}}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Linkedin</label>
                  <input name="linkedin" type="text" class="form-control" placeholder="Enter ..." value="{{$settings->linkedin}}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Twitter</label>
                  <input name="twitter" type="text" class="form-control" placeholder="Enter ..." value="{{$settings->twitter}}">
                </div>
              </div>
            </div>
      
            <div class="row">
                <div class="col col-12">
                  <button type="submit" class="btn btn-primary w-100"> Submit </button>
                </div>
            </div>
      
      
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
    </div>
</x-admin.app-layout>
