import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    name: string;
    href: string;
    is_active: number;
};

export default function Create() {
    const important_links =
        ((usePage<SharedData>().props as any)?.data as any) || [];
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Important Link',
            href: '/admin/important_links',
        },
        {
            title: 'Detail',
            href: route('admin.important_links.show', important_links.id),
        },
        {
            title: 'Edit',
            href: '',
        },
    ];

    const initialValues: FormType = {
        name: important_links.name,
        href: important_links.href,
        is_active: important_links.is_active,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.important_links.update', important_links.id),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Important Link" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Href"
                    name="href"
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
