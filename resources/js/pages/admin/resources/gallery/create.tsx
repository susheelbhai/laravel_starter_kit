import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    title: string;
    description: string;
    images: string[];
    is_active: number;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Gallery',
        href: '/admin/gallery',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const initialValues: FormType = {
        title: '',
        description: '',
        images: [],
        is_active: 1,
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.gallery.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Gallery item created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Gallery Item" />
            <FormContainer
                onSubmit={submit}
                processing={processing}
                buttonLabel="Create Gallery Item"
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
                    label="Images (Multiple)"
                    name="images"
                    inputDivData={inputDivData}
                    multiple={true}
                />
            </FormContainer>
        </AppLayout>
    );
}

