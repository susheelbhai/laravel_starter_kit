import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    faq_category_id: string;
    question: string;
    answer: string;
    is_active: number;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Faq',
        href: '/admin/faq',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const categories = usePage().props.categories as Array<{ id: number; title: string }>;
    const initialValues: FormType = {
        faq_category_id: '',
        question: '',
        answer: '',
        is_active: 1,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.faq.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Faq" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="select"
                    label="Category"
                    name="faq_category_id"
                    inputDivData={inputDivData}
                    options={categories}
                />
                <InputDiv
                    type="textarea"
                    label="Question"
                    name="question"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Answer"
                    name="answer"
                    inputDivData={inputDivData}
                />
                
            </FormContainer>
        </AppLayout>
    );
}
