import { useForm, usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { ContainerFluid } from '@/components/ui/container-fluid';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem } from '@/types';
import { FormContainer } from '@/components/form/container/form-container';

interface LoginProps {
    submitUrl?: string;
    status?: string;
}
const submitUrl = route('admin.role.store');

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
    const permissions = usePage().props.permissions as any;
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Role',
            href: '/admin/role',
        },
        {
            title: 'Create',
            href: '/dashboard',
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="AIASA Membership Registration">
            <ContainerFluid>
                <FormContainer onSubmit={submit} processing={processing}>
                    <div className="grid gap-6">
                        <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                        <InputDiv type="multicheckbox" label="Permission" name="permissions" inputDivData={inputDivData} options={permissions} />

                        <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Register Now
                        </Button>
                    </div>
                </FormContainer>

            </ContainerFluid>
        </AppLayout>
    );
}
