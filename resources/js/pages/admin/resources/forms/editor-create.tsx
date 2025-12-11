import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    // editor / textarea
    editor: string;
    textarea: string;

};

const initialValues: FormType = {
    editor: '',
    textarea: '',
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Editor Form', href: '/admin/team' },
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
                {/* Editor / Textarea */}
                <InputDiv type="editor" label="Editor" name="editor" inputDivData={inputDivData} />
                <InputDiv type="textarea" label="Textarea" name="textarea" inputDivData={inputDivData} />

            </FormContainer>
        </AppLayout>
    );
}
