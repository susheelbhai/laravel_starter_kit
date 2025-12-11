import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    date: string;
    datetime: string;
};

const initialValues: FormType = {
    date: '',
    datetime: '',
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Simple Form', href: '/admin' },
    { title: 'Create', href: '/admin/forms/date-create' },
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
                <InputDiv
                    type="date"
                    label="Date"
                    name="date"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="datetime-local"
                    label="Date & Time"
                    name="datetime"
                    inputDivData={inputDivData}
                />
            </FormContainer>
        </AppLayout>
    );
}
