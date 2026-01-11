import { FormContainer } from '@/components/form/form-container';
import { InputDiv } from '@/components/form/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type CreateForm = {
    id: number;
    app_name: string;
    short_description: string;
    address: string;
    dark_logo: string;
    light_logo: string;
    favicon: string;
    email: string;
    phone: string;
    facebook: string;
    instagram: string;
    linkedin: string;
    twitter: string;
    youtube: string;
    whatsapp: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Website Settings',
        href: '/admin/setting/general',
    },
    {
        title: 'Edit',
        href: '/dashboard',
    },
];

export default function GeneralSetting() {
    const data = usePage<SharedData>().props.setting as CreateForm;
    const initialValues = {
        id: data.id,
        app_name: data.app_name || '',
        short_description: data.short_description || '',
        address: data.address || '',
        dark_logo: data.dark_logo || '',
        light_logo: data.light_logo || '',
        favicon: data.favicon || '',
        email: data.email || '',
        phone: data.phone || '',
        facebook: data.facebook || '',
        instagram: data.instagram || '',
        linkedin: data.linkedin || '',
        twitter: data.twitter || '',
        youtube: data.youtube || '',
        whatsapp: data.whatsapp || '',
    };

    const { submit, inputDivData, processing } = useFormHandler<CreateForm>({
        url: route('admin.settings.general', initialValues.id),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Service" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="App Name"
                    name="app_name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Description"
                    name="short_description"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="textarea"
                    label="Address"
                    name="address"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Favicon"
                    name="favicon"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Dark Logo"
                    name="dark_logo"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Light Logo"
                    name="light_logo"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Phone"
                    name="phone"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Email"
                    name="email"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Facebook"
                    name="facebook"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Twitter"
                    name="twitter"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Linkedin"
                    name="linkedin"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Instagram"
                    name="instagram"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Youtube"
                    name="youtube"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="text"
                    label="Whatsapp"
                    name="whatsapp"
                    inputDivData={inputDivData}
                />
                
            </FormContainer>
        </AppLayout>
    );
}
