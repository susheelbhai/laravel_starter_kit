import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { BreadcrumbItem, SharedData } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

type CreateForm = {
    content: string;
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
    const setting =
        ((usePage<SharedData>().props as any)?.setting as {
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
        }) || [];
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        app_name: setting.app_name,
        short_description: setting.short_description,
        address: setting.address,
        dark_logo: setting.dark_logo,
        light_logo: setting.light_logo,
        favicon: setting.favicon,
        email: setting.email,
        phone: setting.phone,
        facebook: setting.facebook,
        instagram: setting.instagram,
        linkedin: setting.linkedin,
        twitter: setting.twitter,
        youtube: setting.youtube,
        whatsapp: setting.whatsapp,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        const formData = new FormData();

        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });

        // 👇 Spoof the PUT method
        formData.append('_method', 'patch');

        router.post(route('admin.settings.general', setting.id), formData, {
            forceFormData: true, // Ensures Inertia sends as multipart/form-data
            onSuccess: () => reset(),
            onError: (errors) => console.log('Validation errors:', errors),
        });
    };
    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Service" />
            <form onSubmit={submit} className="space-y-6 p-6">
                <InputDiv type="text" label="App Name" name="app_name" inputDivData={inputDivData} />
                <InputDiv type="textarea" label="Description" name="short_description" inputDivData={inputDivData} />
                <InputDiv type="textarea" label="Address" name="address" inputDivData={inputDivData} />
                <InputDiv type="image" label="Favicon" name="favicon" inputDivData={inputDivData} />
                <InputDiv type="image" label="Dark Logo" name="dark_logo" inputDivData={inputDivData} />
                <InputDiv type="image" label="Light Logo" name="light_logo" inputDivData={inputDivData} />
                <InputDiv type="text" label="Phone" name="phone" inputDivData={inputDivData} />
                <InputDiv type="text" label="Email" name="email" inputDivData={inputDivData} />
                <InputDiv type="text" label="Facebook" name="facebook" inputDivData={inputDivData} />
                <InputDiv type="text" label="Twitter" name="twitter" inputDivData={inputDivData} />
                <InputDiv type="text" label="Linkedin" name="linkedin" inputDivData={inputDivData} />
                <InputDiv type="text" label="Instagram" name="instagram" inputDivData={inputDivData} />
                <InputDiv type="text" label="Youtube" name="youtube" inputDivData={inputDivData} />

                <InputDiv type="text" label="Whatsapp" name="whatsapp" inputDivData={inputDivData} />

                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting...' : 'Submit'}
                </Button>
            </form>
        </AppLayout>
    );
}
