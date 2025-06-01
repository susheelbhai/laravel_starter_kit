import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { router } from '@inertiajs/react';

type CreateForm = {
    heading1: string;
    heading2: string;
    paragraph1: string;
    paragraph2: string;
    btn_name: string;
    btn_url: string;
    btn_target: string;
    image1: string | File;
    image2: string | File;
    is_active: number;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slider',
        href: '/admin/slider1',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const slider =
        ((usePage<SharedData>().props as any)?.data as {
            heading1: "",
            heading2: "",
            paragraph1: "",
            paragraph2: "",
            btn_name: "",
            btn_url: "",
            btn_target: "",
            is_active: "",
            image1: "",
            image2: "",
        }) || [];

    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        heading1: slider.heading1,
        heading2: slider.heading2,
        paragraph1: slider.paragraph1,
        paragraph2: slider.paragraph2,
        btn_name: slider.btn_name,
        btn_url: slider.btn_url,
        btn_target: slider.btn_target,
        image1: slider.image1,
        image2: slider.image2,
        is_active: slider.is_active || 1,

    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
    
        const formData = new FormData();
    
        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });
    
        // 👇 Spoof the PUT method
        formData.append('_method', 'PUT');
    
        router.post(route('admin.slider1.update', slider.id), formData, {
            forceFormData: true, // Ensures Inertia sends as multipart/form-data
            onSuccess: () => reset(),
            onError: (errors) => console.log('Validation errors:', errors),
        });
    };
    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Slider" />
            <form onSubmit={submit} className="space-y-6 p-6">
                
                <InputDiv type="text" label="Heading 1" name="heading1" inputDivData={inputDivData} />
                <InputDiv type="text" label="Heading 2" name="heading2" inputDivData={inputDivData} />
                <InputDiv type="text" label="Paragraph 1" name="paragraph1" inputDivData={inputDivData} />
                <InputDiv type="text" label="Paragraph 2" name="paragraph2" inputDivData={inputDivData} />
                <InputDiv type="text" label="Button Name" name="btn_name" inputDivData={inputDivData} />
                <InputDiv type="text" label="Button URL" name="btn_url" inputDivData={inputDivData} />
                <InputDiv type="text" label="Button Target" name="btn_target" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image 1" name="image1" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image 2" name="image2" inputDivData={inputDivData} />

                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
