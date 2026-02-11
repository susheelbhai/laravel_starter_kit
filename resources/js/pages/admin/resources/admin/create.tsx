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

type AdminForm = {
    name: string;
    dob: string;
    profile_pic: File | null;
    address: string;
    city: string;
    state: string;
    email: string;
    phone: string;
    roles: number[]; // will be handled by useFormHandler (id/value extracted)
    permissions: number[]; // same here
};

export default function CreateAdmin() {
    const page = usePage<SharedData>();

    const rolesFromServer = (page.props as { roles: Role[] }).roles;
    const permissionsFromServer = (page.props as { permissions: Permission[] }).permissions;

    // ✅ Map roles & permissions to { id, title } for multicheckbox
    const roleOptions = rolesFromServer.map((role) => ({
        id: role.id,
        title: role.name ?? role.title,
    }));

    const permissionOptions = permissionsFromServer.map((permission) => ({
        id: permission.id,
        title: permission.name ?? permission.title,
    }));

    const initialValues: AdminForm = {
        name: '',
        dob: '',
        profile_pic: null,
        address: '',
        city: '',
        state: '',
        email: '',
        phone: '',
        roles: [],
        permissions: [],
    };

    const { submit, inputDivData, processing } = useFormHandler<AdminForm>({
        url: route('admin.admin.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => {
            console.log('Admin created successfully');
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
        title: 'Admin Create',
        href: '/admin/admin',
    },
];

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="Create Admin">
            <ContainerFluid>
                <FormContainer onSubmit={submit} processing={processing} buttonLabel='Create Admin'>
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
