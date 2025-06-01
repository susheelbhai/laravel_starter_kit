import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
    id: number | string;
    name: string;
    roles: string[];
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

export default function Create() {
    const permission =
        ((usePage<SharedData>().props as any)?.data as {
            id: number | string;
            name: string;
            roles?: string[];
        }) || [];

    const { setData, post, processing, errors, reset, data, setError } = useForm<Required<CreateForm>>({
        id: permission.id,
        name: permission.name || '',
        roles: Array.isArray(permission.roles) ? permission.roles : [],
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        const formData = new FormData();

        formData.append('name', data.name);

        // ✅ Only send string values (not objects)
        (data.roles || []).forEach((perm) => {
            if (typeof perm === 'string') {
                formData.append('roles[]', perm);
            } else if (perm?.value) {
                formData.append('roles[]', perm.value);
            }
        });

        formData.append('_method', 'PUT');

        router.post(route('admin.permission.update', permission.id), formData, {
            forceFormData: true,
            onSuccess: () => reset(),
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

    const roles = usePage().props.roles as any; // You may type this better if possible

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Role" />
            <form onSubmit={submit} className="space-y-6 p-6">
                
                <InputDiv label="Name" name="name" type="text" inputDivData={inputDivData} />

                <InputDiv type="checkbox" label="Permissions" name="roles" inputDivData={inputDivData} options={roles} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
