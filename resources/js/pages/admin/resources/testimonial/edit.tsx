import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
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
        ((usePage<SharedData>().props as any)?.data as FormType) || [];
    const initialValues: FormType = {
        id: testimonial.id,
        name: testimonial.name,
        designation: testimonial.designation,
        organisation: testimonial.organisation,
        message: testimonial.message,
        is_active: testimonial.is_active,
        image: testimonial.image,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.testimonial.update', testimonial.id),
        initialValues,
        method: 'PUT',
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Testimonial" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Designation"
                    name="designation"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Organisation"
                    name="organisation"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label=" Message"
                    name="message"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Image"
                    name="image"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="switch"
                    label="Active"
                    name="is_active"
                    inputDivData={inputDivData}
                />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
