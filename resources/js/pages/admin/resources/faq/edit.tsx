import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

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
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function Create() {
    const categories = usePage().props.categories as any;
    const faq = ((usePage<SharedData>().props as any)?.data as any) || [];

    const initialValues: FormType = {
        faq_category_id: faq.faq_category_id,
        question: faq.question,
        answer: faq.answer,
        is_active: faq.is_active ?? 1,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.faq.update', faq.id),
        initialValues,
        method: 'PATCH',
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
                <InputDiv
                    type="switch"
                    label="Active"
                    name="is_active"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
