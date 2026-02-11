import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

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

interface TestimonialEditPageProps extends SharedData {
    data: FormType;
}

export default function Create() {
    const testimonial = usePage<TestimonialEditPageProps>().props.data || {} as FormType;
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
            <FormContainer onSubmit={submit} processing={processing}>
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

                
            </FormContainer>
        </AppLayout>
    );
}
