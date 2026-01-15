import { usePage } from '@inertiajs/react';

export default function AppLogo() {
    const appData = (usePage().props as any).appData;

    return (
        <>
            <div className="flex items-center justify-center">
                <img
                    src={appData.light_logo}
                    alt="Logo"
                    className="h-10 w-auto"
                />
            </div>
        </>
    );
}
