import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    id: number | string;
    name: string;
    roles: number[]; // store role IDs
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Permission',
        href: '/admin/permission',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

interface PermissionData {
    id: number | string;
    name: string;
    roles?: Array<{ id: number; title: string }>;
}

interface PermissionPageProps {
    data: PermissionData;
    roles: Array<{ id: number; title: string }>;
}

export default function EditPermission() {
    const page = usePage<SharedData>();

    const permission = ((page.props as PermissionPageProps)?.data) || { id: 0, name: '', roles: [] };

    const allRoles = (page.props as PermissionPageProps).roles || [];

    // ✅ Initial values: convert related roles to array of IDs
    const initialValues: FormType = {
        id: permission.id,
        name: permission.name || '',
        roles: Array.isArray(permission.roles)
            ? permission.roles.map((r) => r.id) // [1, 2, 3]
            : [],
    };

    // ✅ Use the same useFormHandler pattern as Role Edit page
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.permission.update', permission.id),
        initialValues,
        method: 'PUT',
        onSuccess: () => console.log('Permission updated successfully!'),
    });

    // ✅ Multicheckbox options: { id, title }
    const roleOptions = allRoles.map((role) => ({
        id: role.id,
        title: role.title,
    }));

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Permission" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    label="Name"
                    name="name"
                    type="text"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="multicheckbox"
                    label="Roles"
                    name="roles"
                    inputDivData={inputDivData}
                    options={roleOptions}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
