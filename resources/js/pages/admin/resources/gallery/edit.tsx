import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    title: string;
    description: string;
    images: { id: number; url: string }[] | null;
    is_active: number;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Gallery',
        href: '/admin/gallery',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Edit() {
    const { data } = usePage().props as any;
    const item = data;

    const initialValues: FormType = {
        title: item.title || '',
        description: item.description || '',
        images: item.media
            ? item.media.map((m: any) => ({ id: m.id, url: m.original_url }))
            : null,
        is_active: item.is_active || 1,
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.gallery.update', item.id),
        initialValues,
        method: 'PUT',
        onSuccess: () => console.log('Gallery item updated successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Gallery Item" />

            <FormContainer
                onSubmit={submit}
                processing={processing}
                buttonLabel="Update Gallery Item"
            >
                <InputDiv
                    type="text"
                    label="Title"
                    name="title"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Description"
                    name="description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="images"
                    label="Images"
                    name="images"
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

