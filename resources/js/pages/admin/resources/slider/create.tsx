import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
    name: string;
    designation: string;
    organisation: string;
    message: string;
    is_active: number;
    logo: string | File;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slider',
        href: '/admin/slider1',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        heading1: "",
        heading2: "",
        paragraph1: "",
        paragraph2: "",
        btn_name: "",
        btn_url: "",
        btn_target: "",
        is_active: 1,
        image1: "",
        image2: "",
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('admin.slider1.store'), {
            // onSuccess: () => reset(),
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
                
                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
