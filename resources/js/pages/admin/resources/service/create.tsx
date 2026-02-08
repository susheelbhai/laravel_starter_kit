import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    title: string;
    author: string;
    tags: string;
    short_description: string;
    long_description1: string;
    long_description2: string;
    long_description3: string;
    category: string;
    is_active: number;
    display_img: string;
    ad_img: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Service',
        href: '/admin/service',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const initialValues: FormType = {
        title: '',
        author: '',
        tags: '',
        short_description: '',
        long_description1: '',
        long_description2: '',
        long_description3: '',
        category: '',
        is_active: 1,
        display_img: '',
        ad_img: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.service.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Service" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Title"
                    name="title"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Author"
                    name="author"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Tags"
                    name="tags"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Short Description"
                    name="short_description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Long Description"
                    name="long_description1"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="editor"
                    label="Long Description 2"
                    name="long_description2"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="editor"
                    label="Long Description 3"
                    name="long_description3"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="text"
                    label="Category"
                    name="category"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Image"
                    name="display_img"
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
