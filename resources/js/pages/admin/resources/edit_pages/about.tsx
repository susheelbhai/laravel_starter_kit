import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { router } from '@inertiajs/react';

type CreateForm = {
    content: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
    {
        title: 'Edit About Page',
        href: '/dashboard',
    },
];

export default function PageContact() {
    const about =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            para1: string;
            para2: string;
            objective: string;
            mission: string;
            vision: string;
            founder_message: string;
            founder_image: string;
            banner: string;
        }) || [];

    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        banner: about.banner,
        founder_image: about.founder_image,
        para1: about.para1,
        para2: about.para2,
        objective: about.objective,
        mission: about.mission,
        vision: about.vision,
        founder_message: about.founder_message,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
    
        const formData = new FormData();
    
        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });
    
        // 👇 Spoof the PUT method
        formData.append('_method', 'patch');
    
        router.post(route('admin.pages.aboutPage'), formData, {
            forceFormData: true, // Ensures Inertia sends as multipart/form-data
            // onSuccess: () => reset(),
            onError: (errors) => console.log('Validation errors:', errors),
        });
    };
    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit About Page" />
            <form onSubmit={submit} className="space-y-6 p-6">
               
                <InputDiv type="editor" label="Paragraph 1" name="para1" inputDivData={inputDivData} />
                <InputDiv type="editor" label="Paragraph 2" name="para2" inputDivData={inputDivData} />
                <InputDiv type="editor" label="objective" name="objective" inputDivData={inputDivData} />
                <InputDiv type="editor" label="Mission" name="mission" inputDivData={inputDivData} />
                <InputDiv type="editor" label="Vision" name="vision" inputDivData={inputDivData} />
                <InputDiv type="editor" label="Founder Message" name="founder_message" inputDivData={inputDivData} />
                <InputDiv type="image" label="Founder Image" name="founder_image" inputDivData={inputDivData} />
                <InputDiv type="image" label="Banner" name="banner" inputDivData={inputDivData} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
