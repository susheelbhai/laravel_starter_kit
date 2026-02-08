import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    id: number;
    name: string;
    designation: string;
    is_active: number;
    image: string | File;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Team',
        href: '/admin/team',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const team =
        ((usePage<SharedData>().props as any)?.data as FormType) || [];

    const initialValues: FormType = {
        id: team.id,
        name: team.name,
        designation: team.designation,
        is_active: team.is_active,
        image: team.image,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.team.update', team.id),
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
                    label="Designation"
                    name="designation"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Image"
                    name="image"
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
