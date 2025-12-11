import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
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
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
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
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('admin.blog.store'), {
            onSuccess: () => reset(),
        });
    };

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Blog" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv type="text" label="Title" name="title" inputDivData={inputDivData} />
                <InputDiv type="text" label="Author" name="author" inputDivData={inputDivData} />
                <InputDiv type="text" label="Tags" name="tags" inputDivData={inputDivData} />
                <InputDiv type="text" label="Short Description" name="short_description" inputDivData={inputDivData} />
                <InputDiv type="editor" label="Long Description" name="long_description1" inputDivData={inputDivData} />

                <InputDiv type="editor" label="Long Description 2" name="long_description2" inputDivData={inputDivData} />

                <InputDiv type="editor" label="Long Description 3" name="long_description3" inputDivData={inputDivData} />

                <InputDiv type="textarea" label="Highlighted Text 1" name="highlighted_text1" inputDivData={inputDivData} />
                <InputDiv type="textarea" label="Highlighted Text 2" name="highlighted_text2" inputDivData={inputDivData} />

                <InputDiv type="text" label="Category" name="category" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image" name="display_img" inputDivData={inputDivData} />
                <InputDiv type="image" label="Ad Image" name="ad_img" inputDivData={inputDivData} />

                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
