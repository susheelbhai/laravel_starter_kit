import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    id: number | string;
    name: string;
    permissions: (string | { value: string })[];
};

const breadcrumbs: BreadcrumbItem[] = [
   
    {
        title: 'Role',
        href: '/admin/role',
    },
    {
        title: 'Edit Role',
        href: '/admin/role',
    },
    
];
interface RoleData {
    id: number | string;
    name: string;
    permissions: Array<{ id: number; name: string }>;
}

interface PermissionOption {
    id: number;
    title?: string;
    name: string;
}

export default function EditRole() {
    const role = ((usePage<SharedData>().props as { data: RoleData })?.data) || {} as RoleData;

    const initialValues: FormType = {
        id: role.id,
        name: role.name,
        permissions: (role.permissions || []).map((p) => p.id), // [1, 2, 3]
    };

    const rawPermissions = usePage().props.permissions as PermissionOption[];
    const permissions = rawPermissions.map((permission) => ({
        id: permission.id,
        title: permission.title ?? permission.name,
    }));

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.role.update', role.id),
        initialValues,
        method: 'PUT',
        onSuccess: () => console.log('Role updated successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Role" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    label="Name"
                    name="name"
                    type="text"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="multicheckbox"
                    label="Permissions"
                    name="permissions"
                    inputDivData={inputDivData}
                    options={permissions} // { id, title }
                />

            </FormContainer>
        </AppLayout>
    );
}
