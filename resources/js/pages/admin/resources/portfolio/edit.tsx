import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { router } from '@inertiajs/react';
import { FormContainer } from '@/components/form/form-container';

type CreateForm = {
    name: string;
    url: string;
    is_active: number;
    logo: string | File;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Portfolio',
        href: '/admin/portfolio',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const portfolio =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            url: string;
            is_active: number;
            logo: string;
        }) || [];

    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        name: portfolio.name,
        url: portfolio.url,
        logo: portfolio.logo || '',
        is_active: portfolio.is_active || 1,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
    
        const formData = new FormData();
    
        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });
    
        // 👇 Spoof the PUT method
        formData.append('_method', 'PUT');
    
        router.post(route('admin.portfolio.update', portfolio.id), formData, {
            forceFormData: true, // Ensures Inertia sends as multipart/form-data
            onSuccess: () => reset(),
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
            <Head title="Create Portfolio" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                <InputDiv type="text" label="Url" name="url" inputDivData={inputDivData} />
                
                <InputDiv type="image" label="Logo" name="logo" inputDivData={inputDivData} />


                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />

                
            </FormContainer>
        </AppLayout>
    );
}
