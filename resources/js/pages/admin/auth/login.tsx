import { Head, useForm, usePage } from '@inertiajs/react';
import { Eye, EyeOff } from 'lucide-react';
import { FormEventHandler, useState } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/admin/auth-layout';
import { FormContainer } from '@/components/form/container/form-container';
import ContinueWithSocial from '@/components/auth/ContinueWithSocial';
import ContinueWithText from '@/components/auth/ContinueWithText';

type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

interface LoginProps {
    submitUrl?: string;
    status?: string;
    canResetPassword: boolean;
}

export default function Login({ submitUrl, status, canResetPassword }: LoginProps) {
    const { data, setData, post, processing, errors, reset } = useForm<Required<LoginForm>>({
        email: '',
        password: '',
        remember: false,
    });

    const [showPassword, setShowPassword] = useState(false);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        if (submitUrl) {
            console.log('Submitting to:', submitUrl);
            post(submitUrl, {
                // onFinish: () => reset('password'),
            });
        } else {
            console.error('Submit URL is not defined.');
        }
    };

    const socialData = usePage().props.socialData as any;
    return (
        <AuthLayout title="Log in to your account" description="Enter your email and password below to log in">
            <Head title="Log in" />
            {socialData.map((item: any, id: number) => {
                const key = Object.keys(item)[0];
                const data = item[key];
                return (
                    <ContinueWithSocial
                        key={id}
                        platform={key as any}
                        href={data.href}
                    />
                );
            })}
            {socialData.length > 0 && <ContinueWithText />}

            <FormContainer
                onSubmit={submit}
                processing={processing}
                buttonLabel="Log in"
            >
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <Label htmlFor="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            autoFocus
                            tabIndex={1}
                            autoComplete="email"
                            value={data.email}
                            onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                                setData('email', e.target.value)
                            }
                            placeholder="email@example.com"
                        />
                        <InputError message={errors.email} />
                    </div>

                    <div className="grid gap-2">
                        <div className="flex items-center">
                            <Label htmlFor="password">Password</Label>
                            {canResetPassword && (
                                <TextLink
                                    href={route('admin.password.request')}
                                    className="ml-auto text-sm"
                                    tabIndex={5}
                                >
                                    Forgot password?
                                </TextLink>
                            )}
                        </div>
                        <div className="relative">
                            <Input
                                id="password"
                                type={showPassword ? 'text' : 'password'}
                                required
                                tabIndex={2}
                                autoComplete="current-password"
                                value={data.password}
                                onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                                    setData('password', e.target.value)
                                }
                                placeholder="Password"
                                className="pr-10"
                            />
                            <Button
                                type="button"
                                variant="ghost"
                                size="sm"
                                className="absolute right-0 top-0 h-full px-3 py-2 hover:bg-transparent"
                                onClick={() => setShowPassword(!showPassword)}
                                tabIndex={-1}
                            >
                                {showPassword ? (
                                    <EyeOff className="h-4 w-4 text-gray-500" />
                                ) : (
                                    <Eye className="h-4 w-4 text-gray-500" />
                                )}
                            </Button>
                        </div>
                        <InputError message={errors.password} />
                    </div>

                    <div className="flex items-center space-x-3">
                        <Checkbox
                            id="remember"
                            name="remember"
                            checked={data.remember}
                            onClick={() => setData('remember', !data.remember)}
                            tabIndex={3}
                        />
                        <Label htmlFor="remember">Remember me</Label>
                    </div>
                </div>
            </FormContainer>
        </AuthLayout>
    );
}
