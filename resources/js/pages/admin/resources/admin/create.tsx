import { useForm, usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { ContainerFluid } from '@/components/ui/container-fluid';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem } from '@/types';

type LoginForm = {
    name: string;
    dob: string;
    profile_pic: string;
    address: string;
    city: string;
    state: string;
    email: string;
    phone: string;
};

interface LoginProps {
    submitUrl?: string;
    status?: string;
}
const submitUrl = route('admin.admin.store');

export default function Login({ status }: LoginProps) {
    console.log(submitUrl);
    const { data, setData, post, processing, errors, reset } = useForm<Required<LoginForm>>({
        name: '',
        dob: '',
        profile_pic: '',
        address: '',
        city: '',
        state: '',
        email: '',
        phone: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        if (submitUrl) {
            console.log('Submitting to:', submitUrl);
            post(submitUrl, {});
        } else {
            console.error('Submit URL is not defined.');
        }
    };

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };
    const universities = usePage().props.universities as any;
    const roles = usePage().props.roles as any;
    const permissions = usePage().props.permissions as any;

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Admin',
            href: '/admin/admin',
        },
        {
            title: 'Create',
            href: '/dashboard',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="Create Admin">
            <ContainerFluid>
                <form className="flex flex-col gap-6" onSubmit={submit}>
                    <div className="grid gap-6">
                        <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                        <InputDiv type="date" label="Date of Birth" name="dob" inputDivData={inputDivData} />
                        <InputDiv type="image" label="Profile Picture" name="profile_pic" inputDivData={inputDivData} widthMultiplier={0.7} />
                        <InputDiv type="textarea" label=" Address" name="address" inputDivData={inputDivData} />
                        <InputDiv type="text" label="City" name="city" inputDivData={inputDivData} />
                        <InputDiv type="text" label="State" name="state" inputDivData={inputDivData} />
                        <InputDiv type="email" label="Email" name="email" inputDivData={inputDivData} />
                        <InputDiv type="tel" label="Phone" name="phone" inputDivData={inputDivData} />

                        <InputDiv type="checkbox" label="Roles" name="roles" inputDivData={inputDivData} options={roles} />

                        <InputDiv type="checkbox" label="Permission" name="permissions" inputDivData={inputDivData} options={permissions} />

                        <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Register Now
                        </Button>
                    </div>
                </form>

                {status && <div className="mb-4 text-center text-sm font-medium text-green-600">{status}</div>}
            </ContainerFluid>
        </AppLayout>
    );
}
