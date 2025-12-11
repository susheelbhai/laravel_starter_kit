import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

type FormType = {
    image: string | File;
    images: (string | File)[];
};

const initialValues: FormType = {
    image: '',
    images: [],
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
                <InputDiv
                    type="image"
                    label="Image"
                    name="image"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="images"
                    label="Multi Image"
                    name="images"
                    inputDivData={inputDivData}
                />
            </FormContainer>
        </AppLayout>
    );
}
