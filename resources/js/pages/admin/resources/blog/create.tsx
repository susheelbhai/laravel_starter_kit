import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

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
    category: string;
    is_active: number;
    display_img: string;
    ad_img: string;
    ad_url: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Blog',
        href: '/admin/blog',
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
        category: '',
        is_active: 1,
        display_img: '',
        ad_img: '',
        ad_url: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.blog.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Blog" />
            <FormContainer onSubmit={submit} processing={processing} buttonLabel="Create Blog">
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
                    type="textarea"
                    label="Highlighted Text 1"
                    name="highlighted_text1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Highlighted Text 2"
                    name="highlighted_text2"
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
                    type="image"
                    label="Ad Image"
                    name="ad_img"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="ad_url"
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
