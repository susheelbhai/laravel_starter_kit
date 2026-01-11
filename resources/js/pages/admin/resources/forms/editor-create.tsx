import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
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
                <InputDiv type="editor" label="CK Editor" name="ckeditor" inputDivData={inputDivData} editorType="ckeditor" />
                <InputDiv type="editor" label="TinyMCE" name="tinymce" inputDivData={inputDivData} editorType="tinymce" />
                <InputDiv type="textarea" label="Textarea" name="textarea" inputDivData={inputDivData} />

            </FormContainer>
        </AppLayout>
    );
}
