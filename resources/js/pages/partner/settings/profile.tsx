import { Transition } from "@headlessui/react";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import type { FormEventHandler } from "react";

import HeadingSmall from "@/components/heading-small";
import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import AppLayout from "@/layouts/partner/app-layout";
import { type BreadcrumbItem, type SharedData } from "@/types";
import SettingsLayout from "../../../themes/admin_default/settings/layout";
import { sidebarNavItems } from "./data";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "Profile settings",
        href: "/settings/profile",
    },
];

type ProfileForm = {
    name: string;
    email: string;
    phone: string;
};

export default function Profile({
    mustVerifyEmail,
    status,
}: {
    mustVerifyEmail: boolean;
    status?: string;
}) {
    const { auth } = usePage<SharedData>().props;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm<ProfileForm>({
            name: auth.user.name,
            email: auth.user.email,
            phone: (auth.user.phone as string) || "",
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        patch(route("partner.profile.update"), {
            preserveScroll: true,
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Profile settings" />
            <SettingsLayout sidebarNavItems={sidebarNavItems}>
                <div className="space-y-6">
                    <HeadingSmall
                        title="Profile information"
                        description="Update your name and email address"
                    />

                    <form onSubmit={submit} className="space-y-6">
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>

                            <Input
                                id="name"
                                className="mt-1 block w-full"
                                value={data.name}
                                onChange={(e) =>
                                    setData("name", e.target.value)
                                }
                                required
                                autoComplete="name"
                                placeholder="Full name"
                            />

                            <InputError
                                className="mt-2"
                                message={errors.name}
                            />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>

                            <Input
                                id="email"
                                type="email"
                                className="mt-1 block w-full"
                                value={data.email}
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }
                                required
                                autoComplete="username"
                                placeholder="Email address"
                            />

                            <InputError
                                className="mt-2"
                                message={errors.email}
                            />
                        </div>
                        <div className="grid gap-2">
                            <Label htmlFor="phone">Phone</Label>

                            <Input
                                id="phone"
                                type="tel"
                                className="mt-1 block w-full"
                                value={data.phone}
                                onChange={(e) =>
                                    setData("phone", e.target.value)
                                }
                                required
                                autoComplete="tel"
                                placeholder="Phone number"
                            />

                            <InputError
                                className="mt-2"
                                message={errors.phone}
                            />
                        </div>

                        {mustVerifyEmail &&
                            auth.user.email_verified_at === null && (
                                <div>
                                    <p className="-mt-4 text-sm text-muted-foreground">
                                        Your email address is unverified.{" "}
                                        <Link
                                            href={route("verification.send")}
                                            method="post"
                                            as="button"
                                            className="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                                        >
                                            Click here to resend the
                                            verification email.
                                        </Link>
                                    </p>

                                    {status === "verification-link-sent" && (
                                        <div className="mt-2 text-sm font-medium text-green-600">
                                            A new verification link has been
                                            sent to your email address.
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
                                <p className="text-sm text-neutral-600">
                                    Saved
                                </p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}
