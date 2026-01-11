import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    title: string;
    content: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Terms & Conditions',
        href: '/dashboard',
    },
];

export default function Create() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        title: data.title,
        content: data.content,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateTncPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Terms & Conditions" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Title"
                    name="title"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Content"
                    name="content"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
