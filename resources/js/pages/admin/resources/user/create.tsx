import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { InputDiv } from '@/components/ui/input-div';

import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User',
        href: route('admin.user.index'),
    },
    {
        title: 'Create',
        href: '/dashboard',
    },
];

type CreateForm = {
    name: string;
    email: string;
    phone: string;
};

export default function Create() {
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        name: '',
        email: '',
        phone: '',
    });

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        const submitUrl = route('admin.user.store');
        if (submitUrl) {
            post(submitUrl, {
                onFinish: () => reset('name', 'email', 'phone'),
                onError: (errors) => {
                    console.log('Validation Errors:', errors);
                    // You may want to manually log or set state for errors if needed
                },
                onSuccess: () => {
                    reset(); // Only reset after successful submission
                },
            });
        } else {
            console.error('Submit URL is not defined.');
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            
            <Head title="Create New User" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                    <div className="p-4">
                        <div className="overflow-x-auto">
                            <form className="flex flex-col gap-6" onSubmit={submit}>
                                <div className="grid gap-6">
                                    
                                 <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                                <InputDiv type="email" label="Email" name="email" inputDivData={inputDivData} />
                                <InputDiv type="tel" label="Phone" name="phone" inputDivData={inputDivData} />

                                    {/* Submit Button */}
                                    <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                                        {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                                        Submit
                                    </Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
