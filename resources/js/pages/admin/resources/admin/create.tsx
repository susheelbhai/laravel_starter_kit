import { usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';

import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import { ContainerFluid } from '@/components/ui/container-fluid';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { type BreadcrumbItem, SharedData } from '@/types';

type AdminForm = {
    name: string;
    dob: string;
    profile_pic: File | null;
    address: string;
    city: string;
    state: string;
    email: string;
    phone: string;
    roles: any[]; // will be handled by useFormHandler (id/value extracted)
    permissions: any[]; // same here
};

export default function CreateAdmin() {
    const page = usePage<SharedData>();

    const rolesFromServer = (page.props as any).roles as any[];
    const permissionsFromServer = (page.props as any).permissions as any[];

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
    }) as any;

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
                <form className="flex flex-col gap-6" onSubmit={submit}>
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

                        <Button
                            type="submit"
                            className="mt-4 w-full"
                            tabIndex={4}
                            disabled={processing}
                        >
                            {processing && (
                                <LoaderCircle className="h-4 w-4 animate-spin" />
                            )}
                            Create Now
                        </Button>
                    </div>
                </form>

                {status && (
                    <div className="mb-4 text-center text-sm font-medium text-green-600">
                        {status}
                    </div>
                )}
            </ContainerFluid>
        </AppLayout>
    );
}
