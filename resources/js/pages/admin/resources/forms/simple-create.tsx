import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    text: string;
    number: string;
    email: string;
    password: string;
    tel: string;
    hidden_field: string;
    default_input: string;
};

const initialValues: FormType = {
    text: '',
    number: '',
    email: '',
    password: '',
    tel: '',
    hidden_field: 'hidden-value',
    default_input: '',
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
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Simple Form" />

            <FormContainer onSubmit={submit} processing={processing}>
                {/* Basic text inputs */}
                <InputDiv
                    type="text"
                    label="Text"
                    name="text"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="number"
                    label="Number"
                    name="number"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="email"
                    label="Email"
                    name="email"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="password"
                    label="Password"
                    name="password"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="tel"
                    label="Phone"
                    name="tel"
                    inputDivData={inputDivData}
                />

                {/* Hidden */}
                <InputDiv
                    type="hidden"
                    label="Hidden Field"
                    name="hidden_field"
                    inputDivData={inputDivData}
                />

                {/* Default (falls back to InputDefault) */}
                <InputDiv
                    type="default"
                    label="Default Input (fallback)"
                    name="default_input"
                    inputDivData={inputDivData}
                />
            </FormContainer>
        </AppLayout>
    );
}
