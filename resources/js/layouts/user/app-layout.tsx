import AppLayoutTemplate from '@/layouts/user/app/app-sidebar-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState, type ReactNode } from 'react';

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
    title: string;
}

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
    const { admin } = usePage<SharedData>().props;
    const appData = (usePage().props as any).appData;
    const { flash = {} } = usePage().props as {
        flash?: { success?: string; warning?: string; error?: string };
    };

    type FlashType = 'success' | 'warning' | 'error';
    const [visibleFlash, setVisibleFlash] = useState<{ type: FlashType; message: string } | null>(
        flash.success
            ? { type: 'success', message: flash.success }
            : flash.warning
              ? { type: 'warning', message: flash.warning }
              : flash.error
                ? { type: 'error', message: flash.error }
                : null,
    );

    useEffect(() => {
        if (flash.success) setVisibleFlash({ type: 'success', message: flash.success });
        else if (flash.warning) setVisibleFlash({ type: 'warning', message: flash.warning });
        else if (flash.error) setVisibleFlash({ type: 'error', message: flash.error });
        else setVisibleFlash(null);

        if (flash.success || flash.warning || flash.error) {
            const timer = setTimeout(() => setVisibleFlash(null), 4000);
            return () => clearTimeout(timer);
        }
    }, [flash.success, flash.warning, flash.error]);

    const colorClasses = {
        success: 'bg-green-100 text-green-800',
        warning: 'bg-yellow-100 text-yellow-800',
        error: 'bg-red-100 text-red-800',
    };
    return (
        <AppLayoutTemplate authUser={admin} breadcrumbs={breadcrumbs} {...props}>
            <Head title={`${title} - ${appData.name}`} />
            <div className="mx-auto max-w-[1320px] items-center justify-between">
                {visibleFlash && (
                    <div className={`mb-4 rounded p-4 text-center ${colorClasses[visibleFlash.type]}`} role="alert">
                        {visibleFlash.message}
                    </div>
                )}
            </div>
            {children}
        </AppLayoutTemplate>
    );
};
