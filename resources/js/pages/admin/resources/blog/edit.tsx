import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
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
    display_img: string | File;
    ad_img: string | File;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Blog',
        href: '/admin/blog',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const blog = ((usePage<SharedData>().props as any)?.data as FormType) || [];

    const initialValues: FormType = {
        id: blog?.id || 0,
        title: blog?.title || '',
        author: blog?.author || '',
        tags: blog?.tags || '',
        short_description: blog?.short_description || '',
        long_description1: blog?.long_description1 || '',
        long_description2: blog?.long_description2 || '',
        long_description3: blog?.long_description3 || '',
        highlighted_text1: blog?.highlighted_text1 || '',
        highlighted_text2: blog?.highlighted_text2 || '',
        category: blog?.category || '',
        is_active: blog?.is_active ?? 1,
        display_img: blog?.display_img || '',
        ad_img: blog?.ad_img || '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.blog.update', blog?.id),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Blog" />
            <form onSubmit={submit} className="space-y-6 p-6">
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
                    type="switch"
                    label="Active"
                    name="is_active"
                    inputDivData={inputDivData}
                />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
