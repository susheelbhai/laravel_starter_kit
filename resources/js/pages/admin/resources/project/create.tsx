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
    highlighted_text1: string;
    highlighted_text2: string;
    ad_url: string;
    views: string;
    is_active: number;
    images: string;
    ad_img: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Project',
        href: '/admin/project',
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
        highlighted_text1: '',
        highlighted_text2: '',
        // category: '',
        ad_url: '',
        views: '',
        is_active: 1,
        images: '',
        ad_img: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.project.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Project" />
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
                    type="textarea"
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
                    type="editor"
                    label="Highlighted Text 1"
                    name="highlighted_text1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Highlighted Text 2"
                    name="highlighted_text2"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="images"
                    label="Images"
                    name="images"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Ad Image"
                    name="ad_img"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="url"
                    label="Ad URL"
                    name="ad_url"
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
