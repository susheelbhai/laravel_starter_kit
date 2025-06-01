import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
    name: string;
    dob: string;
    profile_pic: string | File;
    address: string;
    city: string;
    state: string;
    email: string;
    phone: string;
    university_id: string;
    roles: string[];
    permissions: string[];
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '/admin/admin',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const admin =
        ((usePage<SharedData>().props as any)?.data as Partial<CreateForm> & {
            id: number | string;
        }) || {};

    const { setData, post, processing, errors, reset, data, setError } = useForm<Required<CreateForm>>({
        name: admin.name || '',
        dob: admin.dob || '',
        profile_pic: admin.profile_pic || '',
        address: admin.address || '',
        city: admin.city || '',
        state: admin.state || '',
        email: admin.email || '',
        phone: admin.phone || '',
        university_id: admin.university_id || '',
        roles: Array.isArray(admin.roles) ? admin.roles : [],
        permissions: Array.isArray(admin.permissions) ? admin.permissions : [],
    });

    const universities = usePage().props.universities as any;
    const roles = usePage().props.roles as any;
    const permissions = usePage().props.permissions as any;

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        const formData = new FormData();
        Object.entries(data).forEach(([key, value]) => {
            if (Array.isArray(value)) {
                value.forEach((v) => {
                    formData.append(`${key}[]`, v);
                });
            } else {
                formData.append(key, value as any);
            }
        });

        formData.append('_method', 'PUT');

        router.post(route('admin.admin.update', admin.id), formData, {
            forceFormData: true,
            onError: (errors) => {
                Object.entries(errors).forEach(([key, value]) => {
                    setError(key as keyof CreateForm, value);
                });
            },
        });
    };

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Update Admin" />

            <form onSubmit={submit} className="space-y-6 p-6">
                {/* Optional Top Error Summary */}
                {Object.keys(errors).length > 0 && (
                    <div className="rounded bg-red-100 p-4 text-red-800">
                        <ul>
                            {Object.entries(errors).map(([field, message]) => (
                                <li key={field}>
                                    <strong>{field}:</strong> {message}
                                </li>
                            ))}
                        </ul>
                    </div>
                )}

                <InputDiv label="Name" name="name" type="text" inputDivData={inputDivData} />
                {/* <InputDiv label="Date of Birth" name="dob" type="date" inputDivData={inputDivData} />
                <InputDiv label="Profile Picture" name="profile_pic" type="image" inputDivData={inputDivData} widthMultiplier={0.7} />
                <InputDiv label="Address" name="address" type="text" inputDivData={inputDivData} />
                <InputDiv label="City" name="city" type="text" inputDivData={inputDivData} />
                <InputDiv label="State" name="state" type="text" inputDivData={inputDivData} /> */}
                <InputDiv label="Email" name="email" type="email" inputDivData={inputDivData} />
                <InputDiv label="Phone" name="phone" type="text" inputDivData={inputDivData} />
                {/* <InputDiv type="select" label="University" name="university_id" inputDivData={inputDivData} options={universities} />
                 */}
                <InputDiv type="checkbox" label="Roles" name="roles" inputDivData={inputDivData} options={roles} />
                <InputDiv type="checkbox" label="Permission" name="permissions" inputDivData={inputDivData} options={permissions} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
