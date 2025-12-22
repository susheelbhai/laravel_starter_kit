import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
    banner_heading: string;
    banner_description: string;
    banner_image: string;
    about_heading: string;
    about_description: string;
    about_image: string;
    why_us_heading: string;
    why_us_description: string;
    why_us_image: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Home Page',
        href: '',
    },
];

export default function PageHome() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        id: data.id,
        banner_heading: data.banner_heading,
        banner_description: data.banner_description,
        banner_image: data.banner_image,
        about_heading: data.about_heading,
        about_description: data.about_description,
        about_image: data.about_image,
        why_us_heading: data.why_us_heading,
        why_us_description: data.why_us_description,
        why_us_image: data.why_us_image,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateHomePage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Home Page" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv
                    type="textarea"
                    label="Banner Heading"
                    name="banner_heading"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Banner Description"
                    name="banner_description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Banner Image"
                    name="banner_image"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="About Heading"
                    name="about_heading"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="About Description"
                    name="about_description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="About Image"
                    name="about_image"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Why Us Heading"
                    name="why_us_heading"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Why Us Description"
                    name="why_us_description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Why Us Image"
                    name="why_us_image"
                    inputDivData={inputDivData}
                />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
