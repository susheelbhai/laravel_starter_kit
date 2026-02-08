import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    id: number;
    name: string;
    phone: string;
    email: string;
    profile_pic: string;
};

export default function Create() {
    const seller =
        ((usePage<SharedData>().props as any)?.data as FormType) || [];
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Seller',
            href: '/admin/seller',
        },
        {
            title: 'Detail',
            href: route('admin.seller.show', seller.id),
        },
        {
            title: 'Edit',
            href: route('admin.seller.edit', seller.id),
        },
    ];
    const initialValues: FormType = {
        id: seller.id,
        name: seller.name,
        phone: seller.phone,
        email: seller.email,
        profile_pic: seller.profile_pic,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.seller.update', seller.id),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Team" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Email"
                    name="email"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Phone"
                    name="phone"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Profile Picture"
                    name="profile_pic"
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
