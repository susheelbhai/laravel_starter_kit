import { useForm, usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { ContainerFluid } from '@/components/ui/container-fluid';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem } from '@/types';
import { can } from '@/lib/can';

interface LoginProps {
    submitUrl?: string;
    status?: string;
}
const submitUrl = route('admin.permission.store');

export default function Login({ status }: LoginProps) {
    console.log(submitUrl);
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        permissions: [],
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
    const roles = usePage().props.roles as any;

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Permission',
            href: '/admin/permission',
        },
        {
            title: 'Create',
            href: '/dashboard',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="AIASA Membership Registration">
            <ContainerFluid>
                <form className="flex flex-col gap-6" onSubmit={submit}>
                    <div className="grid gap-6">
                        <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                        <InputDiv type="checkbox" label="Roles" name="roles" inputDivData={inputDivData} options={roles} />

                        {can('all rights') && <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Register Now
                        </Button>}
                    </div>
                </form>

                {status && <div className="mb-4 text-center text-sm font-medium text-green-600">{status}</div>}
            </ContainerFluid>
        </AppLayout>
    );
}
