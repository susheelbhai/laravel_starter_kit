import { Head } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
   heading1: '',
        heading2: '',
        paragraph1: '',
        paragraph2: '',
        btn_name: '',
        btn_url: '',
        btn_target: '',
        is_active: 1,
        image1: '',
        image2: '',
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slider',
        href: '/admin/slider1',
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

export default function Create() {
    const initialValues: FormType = {
        heading1: '',
        heading2: '',
        paragraph1: '',
        paragraph2: '',
        btn_name: '',
        btn_url: '',
        btn_target: '',
        is_active: 1,
        image1: '',
        image2: '',
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.slider1.store'),
        initialValues,
        method: 'POST',
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Slider" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Heading 1"
                    name="heading1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Heading 2"
                    name="heading2"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Paragraph 1"
                    name="paragraph1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Paragraph 2"
                    name="paragraph2"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Button Name"
                    name="btn_name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Button URL"
                    name="btn_url"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Button Target"
                    name="btn_target"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="image"
                    label="Image 1"
                    name="image1"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Image 2"
                    name="image2"
                    inputDivData={inputDivData}
                />

                
            </FormContainer>
        </AppLayout>
    );
}
