import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    title: string;
    content: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Privacy Policy',
        href: '',
    },
];

export default function Create() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        title: data.title,
        content: data.content,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updatePrivacyPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Privacy Policy" />
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
