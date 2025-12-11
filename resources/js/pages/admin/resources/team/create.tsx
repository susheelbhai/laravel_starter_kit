import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { useFormHandler } from '@/lib/use-form-handler';

type FormType = {
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
     const initialValues: FormType = {
            name: '',
            designation: '',
            is_active: 1,
            image: '',
        };
        const { submit, inputDivData, processing } = useFormHandler<FormType>({
            url: route('admin.team.store'),
            initialValues,
            method: 'POST',
            onSuccess: () => console.log('Simple form created successfully!'),
        });

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
