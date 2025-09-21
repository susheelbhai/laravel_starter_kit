import { type BreadcrumbItem, type SharedData } from '@/types';
import { Transition } from '@headlessui/react';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Container } from '@/components/ui/container';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/user/app-layout';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

type ProfileForm = {
    name: string;
    email: string;
    profile_pic: string;
};

export default function Profile({
    mustVerifyEmail,
    status,
}: {
    mustVerifyEmail: boolean;
    status?: string;
}) {
    const { auth } = usePage<SharedData>().props;

    const {
        setData,
        post,
        processing,
        errors,
        reset,
        data,
        recentlySuccessful,
    } = useForm<Required<ProfileForm>>({
        name: auth.user.name,
        email: auth.user.email,
        profile_pic: String(auth.user.profile_pic ?? ''),
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        const formData = new FormData();

        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value as any);
        });

        // 👇 Spoof the PUT method
        formData.append('_method', 'patch');

        router.post(route('profile.update'), formData, {
            forceFormData: true, // Ensures Inertia sends as multipart/form-data
            onSuccess: () => reset(),
            onError: (errors) => console.log('Validation errors:', errors),
        });
    };
    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(
            Object.entries(errors).map(([key, value]) => [
                key,
                value ? [value] : [],
            ]),
        ),
    };

    return (
        <AppLayout title="Profile">
            <Container>
                <HeadingSmall
                    title="Profile information"
                    description="Update your name and email address"
                />

                <form onSubmit={submit} className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div className="flax">
                            <InputDiv
                                type="text"
                                name="name"
                                label="Name"
                                inputDivData={inputDivData}
                            />
                            <InputDiv
                                type="email"
                                name="email"
                                label="Email"
                                inputDivData={inputDivData}
                            />
                           
                        </div>
                        <div className="flax">
                             <InputDiv
                                type="image"
                                name="profile_pic"
                                label="Profile Pic"
                                inputDivData={inputDivData}
                            />
                        </div>
                    </div>

                    {mustVerifyEmail &&
                        auth.user.email_verified_at === null && (
                            <div>
                                <p className="-mt-4 text-sm text-muted-foreground">
                                    Your email address is unverified.{' '}
                                    <Link
                                        href={route('verification.send')}
                                        method="post"
                                        as="button"
                                        className="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                                    >
                                        Click here to resend the verification
                                        email.
                                    </Link>
                                </p>

                                {status === 'verification-link-sent' && (
                                    <div className="mt-2 text-sm font-medium text-green-600">
                                        A new verification link has been sent to
                                        your email address.
                                    </div>
                                )}
                            </div>
                        )}

                    <div className="flex items-center gap-4">
                        <Button disabled={processing}>Save</Button>

                        <Transition
                            show={recentlySuccessful}
                            enter="transition ease-in-out"
                            enterFrom="opacity-0"
                            leave="transition ease-in-out"
                            leaveTo="opacity-0"
                        >
                            <Button className="text-sm text-neutral-600">Saved</Button>
                        </Transition>
                    </div>
                </form>
            </Container>
        </AppLayout>
    );
}
