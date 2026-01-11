import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useFormHandler } from '@/lib/use-form-handler';
import { FormContainer } from '@/components/form/form-container';

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
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                <InputDiv type="text" label="Designation" name="designation" inputDivData={inputDivData} />
                <InputDiv type="image" label="Image" name="image" inputDivData={inputDivData} />
                <InputDiv type="switch" label="Active" name="is_active" inputDivData={inputDivData} />
                
            </FormContainer>
        </AppLayout>
    );
}
