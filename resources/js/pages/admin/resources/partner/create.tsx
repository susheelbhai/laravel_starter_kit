import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem} from '@/types';
import { SharedData } from '@/types';

type FormType = {
    name: string;
    phone: string;
    email: string;
    profile_pic: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Partner',
        href: '/admin/partner',
    },
    {
        title: 'Create',
        href: '/admin/partner/create',
    },
];

export default function Create() {

    const initialValues: FormType = {
        name: '',
        phone: '',
        email: '',
        profile_pic: '',
    };
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.partner.store'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Simple form created successfully!'),
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Team" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
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
                    label="Phone"
                    name="phone"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="image"
                    label="Profile Picture"
                    name="profile_pic"
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
