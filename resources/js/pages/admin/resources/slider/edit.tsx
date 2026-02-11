import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type FormType = {
    id: number;
    heading1: string;
    heading2: string;
    paragraph1: string;
    paragraph2: string;
    btn_name: string;
    btn_url: string;
    btn_target: string;
    image1: string | File;
    image2: string | File;
    is_active: number;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slider',
        href: '/admin/slider1',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

interface SliderEditPageProps extends SharedData {
    data: FormType;
}

export default function Create() {
    const slider = usePage<SliderEditPageProps>().props.data || {} as FormType;

    const initialValues: FormType = {
        id: slider.id,
        heading1: slider.heading1,
        heading2: slider.heading2,
        paragraph1: slider.paragraph1,
        paragraph2: slider.paragraph2,
        btn_name: slider.btn_name,
        btn_url: slider.btn_url,
        btn_target: slider.btn_target,
        image1: slider.image1,
        image2: slider.image2,
        is_active: slider.is_active || 1,
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.slider1.update', slider.id),
        initialValues,
        method: 'PATCH',
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
