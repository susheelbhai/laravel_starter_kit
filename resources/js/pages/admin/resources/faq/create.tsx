import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
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
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const categories = usePage().props.categories as any;
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
            <form onSubmit={submit} className="space-y-6 p-6">
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
                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
