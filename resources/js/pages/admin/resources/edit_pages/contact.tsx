import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    banner: string;
    form_heading1: string;
    form_paragraph1: string;
    map_embad_url: string;
    working_hour: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Contact Page',
        href: '',
    },
];

export default function PageContact() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    const initialValues: FormType = {
        banner: data.banner,
        form_heading1: data.form_heading1,
        form_paragraph1: data.form_paragraph1,
        map_embad_url: data.map_embad_url,
        working_hour: data.working_hour,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateContactPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Contact Page" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Form Heading"
                    name="form_heading1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Form Paragraph"
                    name="form_paragraph1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Map Embed URL"
                    name="map_embad_url"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Working Hour"
                    name="working_hour"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
