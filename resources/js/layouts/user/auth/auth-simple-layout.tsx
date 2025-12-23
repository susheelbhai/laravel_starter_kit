import AppLogoIcon from '@/components/app-logo-icon';
import { Container } from '@/components/ui/container';
import { Link, usePage } from '@inertiajs/react';
import { type PropsWithChildren } from 'react';

interface AuthLayoutProps {
    name?: string;
    title?: string;
    description?: string;
}

export default function AuthSimpleLayout({ children, title, description }: PropsWithChildren<AuthLayoutProps>) {
    const settings = (usePage().props as any).auth.settings ;

    return (
        <Container className="m-auto p-0 bg-background2">
            <div className="p-5  min-h-screen align-middle flex items-center justify-center">
                <div className="flex border border-white rounded-lg overflow-hidden">
                {/* Left side image (hidden on mobile, visible on md+) */}
                <div className="hidden w-1/2 items-center justify-center overflow-hidden bg-muted md:flex">
                    <img
                        src={settings.side_image}
                        alt="Auth illustration"
                        className="h-full w-full object-cover"
                    />
                </div>

                {/* Right side form */}
                <div className="flex w-full items-center justify-center bg-background p-6 md:w-1/2 md:p-10">
                    <div className="w-full max-w-sm">
                        <div className="flex flex-col gap-8">
                            <div className="flex flex-col items-center gap-4">
                                <Link href={route('home')} className="flex flex-col items-center gap-2 font-medium">
                                    <div className="mb-1 flex  items-center justify-center rounded-md">
                                        <AppLogoIcon className="" />
                                    </div>
                                    <span className="sr-only">{title}</span>
                                </Link>

                                <div className="space-y-2 text-center">
                                    <h1 className="text-xl font-medium">{title}</h1>
                                    <p className="text-center text-sm text-muted-foreground">{description}</p>
                                </div>
                            </div>
                            {children}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </Container>
    );
}
