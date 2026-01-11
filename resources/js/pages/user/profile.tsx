import { type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';

import { InputDiv } from '@/components/form/container/input-div';
import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Container } from '@/components/ui/container';
import AppLayout from '@/layouts/user/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';

type FormType = {
    name: string;
    email: string;
    phone?: string;
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
    const [isEditing, setIsEditing] = useState(false);

    const initialValues: FormType = {
        name: auth.user.name,
        email: auth.user.email,
        phone: (auth.user.phone as string | null | undefined) ?? '',
        profile_pic: '',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('profile.update'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => {
            setIsEditing(false);
        },
    });

    const { setData } = inputDivData;

    // 🔑 Keep form in sync with latest auth.user
    useEffect(() => {
        setData('name', auth.user.name);
        setData('email', auth.user.email);
        setData('phone', (auth.user.phone as string | null | undefined) ?? '');
        // don't touch profile_pic here so you don't override file input
    }, [auth.user.name, auth.user.email, auth.user.phone, setData]);

    return (
        <AppLayout title="Profile">
            <Container>
                <HeadingSmall
                    title="Profile information"
                    description={
                        isEditing
                            ? 'Update your name, email and other profile details.'
                            : 'View your profile details. Click edit to make changes.'
                    }
                />

                {/* VIEW MODE */}
                {!isEditing && (
                    <div className="space-y-6">
                        <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div className="space-y-4">
                                <ProfileField
                                    label="Name"
                                    value={auth.user.name}
                                />
                                <ProfileField
                                    label="Email"
                                    value={auth.user.email}
                                />
                                <ProfileField
                                    label="Phone"
                                    value={
                                        (auth.user.phone as string) ||
                                        'Not added'
                                    }
                                />
                            </div>

                            <div className="space-y-4">
                                <p className="text-xs font-semibold text-muted-foreground uppercase">
                                    Profile Picture
                                </p>
                                
                                {auth.user.profile_pic == null ? (
                                    <p className="text-sm text-muted-foreground">
                                        No profile picture uploaded.
                                    </p>
                                ) : (
                                <img src={`${auth.user.profile_pic}`} className='rounded-xl' alt="Profile Picture" />
                                )}
                            </div>
                        </div>

                        <div className="flex items-center gap-4">
                            <Button
                                type="button"
                                onClick={() => setIsEditing(true)}
                            >
                                Edit Profile
                            </Button>
                        </div>
                    </div>
                )}

                {/* EDIT MODE (YOUR EXISTING FORM) */}
                {isEditing && (
                    <form onSubmit={submit} className="mt-6 space-y-6">
                        <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div className="flex flex-col gap-4">
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
                                <InputDiv
                                    type="text"
                                    name="phone"
                                    label="Phone"
                                    inputDivData={inputDivData}
                                />
                            </div>
                            <div className="flex flex-col gap-4">
                                <InputDiv
                                    type="image"
                                    name="profile_pic"
                                    label="Profile Pic"
                                    inputDivData={inputDivData}
                                />
                            </div>
                        </div>

                        <div className="flex items-center gap-4">
                            <Button disabled={processing}>Save</Button>

                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => setIsEditing(false)}
                                disabled={processing}
                            >
                                Cancel
                            </Button>
                        </div>
                    </form>
                )}

                {/* Email verification block – visible in both modes */}
                {mustVerifyEmail && auth.user.email_verified_at === null && (
                    <div className="mt-6">
                        <p className="-mt-2 text-sm text-muted-foreground">
                            Your email address is unverified.{' '}
                            <Link
                                href={route('verification.send')}
                                method="post"
                                as="button"
                                className="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>

                        {status === 'verification-link-sent' && (
                            <div className="mt-2 text-sm font-medium text-green-600">
                                A new verification link has been sent to your
                                email address.
                            </div>
                        )}
                    </div>
                )}
            </Container>
        </AppLayout>
    );
}

/**
 * Small presentational component for read-only fields
 */
function ProfileField({ label, value }: { label: string; value: string }) {
    return (
        <div>
            <p className="text-xs font-semibold text-muted-foreground uppercase">
                {label}
            </p>
            <p className="mt-1 text-sm font-medium text-foreground">{value}</p>
        </div>
    );
}
