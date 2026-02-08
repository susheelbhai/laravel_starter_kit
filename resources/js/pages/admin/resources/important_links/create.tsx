import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    name: string;
    href: string;
    is_active: number;
    display_img: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Important Link',
        href: '/admin/important_links',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const initialValues: FormType = {
        name: '',
        href: '',
        is_active: 1,
        display_img: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.important_links.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Important Link" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Href"
                    name="href"
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
