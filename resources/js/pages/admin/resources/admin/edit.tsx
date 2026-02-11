import { usePage } from '@inertiajs/react';

import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { ContainerFluid } from '@/components/ui/container-fluid';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { SharedData } from '@/types';
import { type BreadcrumbItem } from '@/types';

interface Role {
    id: number;
    name: string;
    title?: string;
}

interface Permission {
    id: number;
    name: string;
    title?: string;
}

interface AdminData {
    id: number | string;
    name?: string;
    dob?: string;
    profile_pic?: string;
    address?: string;
    city?: string;
    state?: string;
    email?: string;
    phone?: string;
    roles?: { id: number; name: string }[];
    permissions?: { id: number; name: string }[];
}

type AdminForm = {
    id: number | string;
    name: string;
    dob: string;
    profile_pic: File | string | null;
    address: string;
    city: string;
    state: string;
    email: string;
    phone: string;
    roles: number[]; // handled by useFormHandler (id/value extraction)
    permissions: number[]; // same here
};

export default function EditAdmin() {
    const page = usePage<SharedData>();

    // 🧩 Admin being edited (coming from controller as props.data)
    const admin = ((page.props as { data?: AdminData }).data) || {} as AdminData;

    const rolesFromServer = (page.props as SharedData & { roles: Role[] }).roles;
    const permissionsFromServer = (page.props as SharedData & { permissions: Permission[] }).permissions;

    // ✅ Map roles & permissions to { id, title } for multicheckbox
    const roleOptions = rolesFromServer.map((role) => ({
        id: role.id,
        title: role.name ?? role.title,
    }));

    const permissionOptions = permissionsFromServer.map((permission) => ({
        id: permission.id,
        title: permission.name ?? permission.title,
    }));

    // ✅ Pre-fill initial values from admin, including selected roles/permissions
    const initialValues: AdminForm = {
        id: admin.id,
        name: admin.name ?? '',
        dob: admin.dob ?? '',
        profile_pic: admin.profile_pic ?? null,
        address: admin.address ?? '',
        city: admin.city ?? '',
        state: admin.state ?? '',
        email: admin.email ?? '',
        phone: admin.phone ?? '',
        roles: Array.isArray(admin.roles)
            ? admin.roles.map((r) => r.id)
            : [],
        permissions: Array.isArray(admin.permissions)
            ? admin.permissions.map((p) => p.id)
            : [],
    };

    const { submit, inputDivData, processing } = useFormHandler<AdminForm>({
        url: route('admin.admin.update', admin.id),
        initialValues,
        method: 'PUT',
        onSuccess: () => {
            console.log('Admin updated successfully');
        },
    });

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/admin',
        },
        {
            title: 'Admin',
            href: '/admin/admin',
        },
        {
            title: 'Admin Detail',
            href: `/admin/admin/${admin.id}`,
        },
        {
            title: 'Admin Edit',
            href: `/admin/admin/${admin.id}/edit`,
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="Edit Admin">
            <ContainerFluid>
                <FormContainer onSubmit={submit} processing={processing} buttonLabel='Update Admin'>
                    <div className="grid gap-6">
                        <InputDiv
                            type="text"
                            label="Name"
                            name="name"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="date"
                            label="Date of Birth"
                            name="dob"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="image"
                            label="Profile Picture"
                            name="profile_pic"
                            inputDivData={inputDivData}
                            widthMultiplier={0.7}
                        />
                        <InputDiv
                            type="textarea"
                            label="Address"
                            name="address"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="text"
                            label="City"
                            name="city"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="text"
                            label="State"
                            name="state"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="email"
                            label="Email"
                            name="email"
                            inputDivData={inputDivData}
                        />
                        <InputDiv
                            type="tel"
                            label="Phone"
                            name="phone"
                            inputDivData={inputDivData}
                        />

                        <InputDiv
                            type="multicheckbox"
                            label="Roles"
                            name="roles"
                            inputDivData={inputDivData}
                            options={roleOptions}
                        />

                        <InputDiv
                            type="multicheckbox"
                            label="Permissions"
                            name="permissions"
                            inputDivData={inputDivData}
                            options={permissionOptions}
                        />

                     
                    </div>
                </FormContainer >

            </ContainerFluid>
        </AppLayout>
    );
}
