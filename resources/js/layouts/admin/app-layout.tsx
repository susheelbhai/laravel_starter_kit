import AppLayoutTemplate from '@/layouts/admin/app/app-sidebar-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState, type ReactNode } from 'react';
import { footerNavItems, mainNavItems, profileNavItems } from './side-menu';

interface AppLayoutProps {
  children: ReactNode;
  breadcrumbs?: BreadcrumbItem[];
  title?: string;
}

type FlashType = 'success' | 'warning' | 'error';

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
  breadcrumbs = [{ title: 'Dasshboard', href: '/admin' }, ...(breadcrumbs || [])];

  const { admin } = usePage<SharedData>().props;
  const { flash = {} } = usePage().props as {
    flash?: { success?: string; warning?: string; error?: string };
  };

  const [visibleFlash, setVisibleFlash] = useState<{
    type: FlashType;
    message: string;
  } | null>(null);

  // 🔁 Handle flash on every Inertia response
  useEffect(() => {
    if (flash.success) {
      setVisibleFlash({ type: 'success', message: flash.success });
    } else if (flash.warning) {
      setVisibleFlash({ type: 'warning', message: flash.warning });
    } else if (flash.error) {
      setVisibleFlash({ type: 'error', message: flash.error });
    } else {
      setVisibleFlash(null);
      return;
    }

    // ⏱ Auto-hide after 3 seconds
    const timer = setTimeout(() => {
      setVisibleFlash(null);
    }, 3000);

    return () => clearTimeout(timer);
  }, [flash]); // 👈 depend on entire flash object so it runs even if message text is same

  const colorClasses: Record<FlashType, string> = {
    success: 'border-green-500 bg-green-50 text-green-700',
    warning: 'border-yellow-500 bg-yellow-50 text-yellow-700',
    error: 'border-red-500 bg-red-50 text-red-700',
  };

  return (
    <AppLayoutTemplate
      authUser={admin}
      mainNavItems={mainNavItems}
      footerNavItems={footerNavItems}
      profileNavItems={profileNavItems}
      breadcrumbs={breadcrumbs}
      {...props}
    >
      {/* 🔔 Global flash message */}
      {visibleFlash && (
        <div
          className={`mb-4 flex items-center justify-between gap-3 rounded-md border px-4 py-2 text-sm shadow-sm ${colorClasses[visibleFlash.type]}`}
          role="alert"
        >
          <span>{visibleFlash.message}</span>
        </div>
      )}

      <Head title={title || 'Admin Dashboard'} />

      {children}
    </AppLayoutTemplate>
  );
};
