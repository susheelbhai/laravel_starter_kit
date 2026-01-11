import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
    name: string;
    phone: string;
    email: string;
    profile_pic: string;
};

export default function Create() {
    const partner =
        ((usePage<SharedData>().props as any)?.data as FormType) || [];
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Partner',
            href: '/admin/partner',
        },
        {
            title: 'Detail',
            href: route('admin.partner.show', partner.id),
        },
        {
            title: 'Edit',
            href: route('admin.partner.edit', partner.id),
        },
    ];
    const initialValues: FormType = {
        id: partner.id,
        name: partner.name,
        phone: partner.phone,
        email: partner.email,
        profile_pic: partner.profile_pic,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.partner.update', partner.id),
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
