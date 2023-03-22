<x-admin.app-layout>

    @php
        $details = [
            ['name'=> 'heading1','lbl'=> 'Heading 1', 'class'=>'col50', 'value'=>$data->heading1 ],
            ['name'=> 'heading2','lbl'=> 'Heading 2', 'class'=>'col50', 'value'=>$data->heading2 ],
            ['name'=> 'paragraph1','lbl'=> 'Paragraph 1', 'class'=>'col50', 'value'=>$data->paragraph1 ],
            ['name'=> 'paragraph2','lbl'=> 'Paragraph 2', 'class'=>'col50', 'value'=>$data->paragraph2 ],
            ['name'=> 'image1','lbl'=> 'Image 1', 'image'=>true, 'class'=>'col50', 'value'=>asset('storage/images/webpages/banners/' . $data->image1) ],
            ['name'=> 'image2','lbl'=> 'Image 2', 'image'=>true, 'class'=>'col50', 'value'=>asset('storage/images/webpages/banners/' . $data->image2) ],
            ['name'=> 'btn_name','lbl'=> 'Button Name', 'class'=>'col50', 'value'=>$data->btn_name ],
            ['name'=> 'btn_url','lbl'=> 'Button Url', 'class'=>'col50', 'value'=>$data->btn_url ],
            ['name'=> 'btn_target','lbl'=> 'Button Target', 'class'=>'col50', 'value'=>$data->btn_target ],
            ['name'=> 'is_active','lbl'=> 'Active Status', 'type'=>'switch', 'value'=>$data->is_active ],
        ];
    @endphp
    <x-admin.form.form1 method="post" heading="Edit Banner Slider" :details="$details" :action="route('admin.slider1.update', $data->id)">
        @method('patch')
    </x-admin.form.form1>

</x-admin.app-layout>
