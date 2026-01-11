import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    id: number;
    para1: string;
    para2: string;
    objective: string;
    mission: string;
    vision: string;
    founder_message: string;
    founder_image: string;
    banner: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit About Page',
        href: '',
    },
];

export default function PageContact() {
    const data = ((usePage<SharedData>().props as any)?.data as any) || [];
    console.log('About Page Data:', data);
    const initialValues: FormType = {
        id: data.id,
        para1: data.para1,
        para2: data.para2,
        objective: data.objective,
        mission: data.mission,
        vision: data.vision,
        founder_message: data.founder_message,
        founder_image: data.founder_image,
        banner: data.banner,
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.pages.updateAboutPage'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit About Page" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="editor"
                    label="Paragraph 1"
                    name="para1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Paragraph 2"
                    name="para2"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="objective"
                    name="objective"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Mission"
                    name="mission"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Vision"
                    name="vision"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="editor"
                    label="Founder Message"
                    name="founder_message"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Founder Image"
                    name="founder_image"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Banner"
                    name="banner"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
