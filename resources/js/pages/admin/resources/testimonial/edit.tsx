import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { router } from '@inertiajs/react';

type CreateForm = {
    name: string;
    designation: string;
    organisation: string;
    message: string;
    is_active: number;
    image: string | File;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Testimonial',
        href: '/admin/testimonial',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const testimonial =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            designation: string;
            organisation: string;
            message: string;
            is_active: number;
            image: string;
        }) || [];

    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        name: testimonial.name,
        designation: testimonial.designation,
        organisation: testimonial.organisation || '',
        message: testimonial.message || '',
        image: testimonial.image || '',
        is_active: testimonial.is_active ?? 1,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
    
        const formData = new FormData();
    
        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });
    
        // 👇 Spoof the PUT method
        formData.append('_method', 'PUT');
    
        router.post(route('admin.testimonial.update', testimonial.id), formData, {
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
            <Head title="Create Testimonial" />
            <form onSubmit={submit} className="space-y-6 p-6">
                 <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                <InputDiv type="text" label="Designation" name="designation" inputDivData={inputDivData} />
                <InputDiv type="text" label="Organisation" name="organisation" inputDivData={inputDivData} />
                <InputDiv type="text" label=" Message" name="message" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image" name="image" inputDivData={inputDivData} />

                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
