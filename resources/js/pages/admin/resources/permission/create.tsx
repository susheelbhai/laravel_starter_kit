import { useForm, usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import type { FormEventHandler } from 'react';

import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import { ContainerFluid } from '@/components/ui/container-fluid';
import AppLayout from '@/layouts/admin/app-layout';
import { can } from '@/lib/can';
import { type BreadcrumbItem } from '@/types';

const submitUrl = route('admin.permission.store');

export default function CreatePermission() {
    console.log(submitUrl);
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        roles: [],
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
    const roles = usePage().props.roles as Array<{ id: number; name: string }>;

    console.log('Available roles:', roles);
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
                <FormContainer onSubmit={submit} processing={processing}>
                    <div className="grid gap-6">
                        <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                        <InputDiv type="multicheckbox" label="Roles" name="roles" inputDivData={inputDivData} options={roles} />

                        {can('all rights') && <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                            {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                            Create Now
                        </Button>}
                    </div>
                </FormContainer>

                {/* Status removed as it's not used */}
            </ContainerFluid>
        </AppLayout>
    );
}
