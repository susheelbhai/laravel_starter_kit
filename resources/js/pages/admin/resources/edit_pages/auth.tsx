import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
    side_image: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Auth Page',
        href: '',
    },
];

export default function PageAuth() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        id: data.id,
        side_image: data.side_image,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateAuthPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Auth Page" />
            <FormContainer onSubmit={submit} processing={processing}>
                
                <InputDiv
                    type="image"
                    label="Side Image"
                    name="side_image"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
