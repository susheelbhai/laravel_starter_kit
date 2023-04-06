<x-admin.app-layout>
    <x-slot name="head">
        <title> Slider 1  | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

    @php
        $details = [
            ['name'=> 'heading1','lbl'=> 'Heading 1', 'class'=>'col50' ],
            ['name'=> 'heading2','lbl'=> 'Heading 2', 'class'=>'col50' ],
            ['name'=> 'paragraph1','lbl'=> 'Paragraph 1', 'class'=>'col50' ],
            ['name'=> 'paragraph2','lbl'=> 'Paragraph 2', 'class'=>'col50' ],
            ['name'=> 'image1','lbl'=> 'Image 1', 'image'=>true, 'class'=>'col50' ],
            ['name'=> 'image2','lbl'=> 'Image 2', 'image'=>true, 'class'=>'col50' ],
            ['name'=> 'btn_name','lbl'=> 'Button Name', 'class'=>'col50' ],
            ['name'=> 'btn_url','lbl'=> 'Button Url', 'class'=>'col50' ],
            ['name'=> 'btn_target','lbl'=> 'Button Target', 'class'=>'col50' ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch' ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Add Banner Slider" :details="$details" :action="route('admin.slider1.store')" />

</x-admin.app-layout>
