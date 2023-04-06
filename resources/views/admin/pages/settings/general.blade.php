
<x-admin.app-layout>
    
  <x-slot name="head">
      <title> General Settings </title>
  </x-slot>

  <x-admin.dashboard.heading1 heading="Setting" />


  <div class="container-fluid">

    @php
    $details = [
        ['name'=> 'app_name','lbl'=> 'App Name', 'value'=>$settings->app_name, 'class'=>'col50' ],
        ['name'=> 'favicon','lbl'=> 'Favicon', 'image'=>true, 'value'=>asset('storage/images/webpages/logo/' . $settings->favicon), 'class'=>'col50' ],
        ['name'=> 'dark_logo','lbl'=> 'Dark Logo', 'image'=>true, 'value'=>asset('storage/images/webpages/logo/' . $settings->dark_logo), 'class'=>'col50' ],
        ['name'=> 'light_logo','lbl'=> 'Light Logo', 'image'=>true, 'value'=>asset('storage/images/webpages/logo/' . $settings->light_logo), 'class'=>'col50' ],
        ['name'=> 'color1','lbl'=> 'Theme Color 1', 'type'=>'color', 'value'=>$settings->color1, 'class'=>'col50' ],
        ['name'=> 'color2','lbl'=> 'Theme Color 2', 'type'=>'color', 'value'=>$settings->color2, 'class'=>'col50' ],
    ];
    @endphp
    <x-admin.form.form1 method="post" heading="General Setting" :details="$details" :action="route('admin.settings.general')" />


  </div>
</x-admin.app-layout>
