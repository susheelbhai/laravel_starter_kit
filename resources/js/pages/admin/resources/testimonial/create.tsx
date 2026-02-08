import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
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
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const initialValues: FormType = {
        name: '',
        designation: '',
        organisation: '',
        message: '',
        is_active: 1,
        image: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.testimonial.store'),
        initialValues,
        method: 'POST',
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
