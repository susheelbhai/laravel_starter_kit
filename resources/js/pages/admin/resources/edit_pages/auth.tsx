import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
    side_image: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Auth Page',
        href: '',
    },
];

export default function PageAuth() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        id: data.id,
        side_image: data.side_image,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateAuthPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Auth Page" />
            <form onSubmit={submit} className="space-y-6 p-6">
                
                <InputDiv
                    type="image"
                    label="Side Image"
                    name="side_image"
                    inputDivData={inputDivData}
                />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
