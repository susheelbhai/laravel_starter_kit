import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
   

    file: string | File;
    files: (string | File)[];

};

const initialValues: FormType = {
 
    file: '',
    files: [],

};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Simple Form', href: '/admin/team' },
    { title: 'Create', href: '/admin/team/create' },
];

export default function CreateForm() {
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.forms.simple.store'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    const states = usePage().props.states as { id: string; title: string }[];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Simple Form" />

            <FormContainer onSubmit={submit} processing={processing}>
                
                {/* File / Multi File */}
                <InputDiv type="file" label="File" name="file" inputDivData={inputDivData} />
                <InputDiv type="files" label="Multi File" name="files" inputDivData={inputDivData} />

            </FormContainer>
        </AppLayout>
    );
}
