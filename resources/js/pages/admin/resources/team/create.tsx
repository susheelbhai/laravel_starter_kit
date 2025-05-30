import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
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
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        name:'',
        designation:'',
        image:'',
        is_active:1,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('admin.team.store'), {
            onSuccess: () => reset(),
        });
    };

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Team" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                <InputDiv type="text" label="Designation" name="designation" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image" name="image" inputDivData={inputDivData} />

                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />
                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
