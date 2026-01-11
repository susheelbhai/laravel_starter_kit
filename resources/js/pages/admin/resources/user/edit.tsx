import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    name: string;
    phone: string;
    email: string;
    profile_pic: string;
};

export default function Create() {
    const user = ((usePage<SharedData>().props as any)?.data as any) || [];
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'User',
            href: '/admin/user',
        },
        {
            title: 'Detail',
            href: route('admin.user.show', user.id),
        },
        {
            title: 'Edit',
            href: route('admin.user.edit', user.id),
        },
    ];
    const initialValues: FormType = {
        name: user.name,
        phone: user.phone,
        email: user.email,
        profile_pic: user.profile_pic,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.user.update', user.id),
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
