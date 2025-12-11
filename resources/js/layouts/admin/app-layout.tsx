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

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
  breadcrumbs = [{ title: 'Dasshboard', href: '/admin' }, ...(breadcrumbs || [])];
  const { admin } = usePage<SharedData>().props;
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
      : null
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
    <AppLayoutTemplate
      authUser={admin}
      mainNavItems={mainNavItems}
      footerNavItems={footerNavItems}
      profileNavItems={profileNavItems}
      breadcrumbs={breadcrumbs}
      {...props}
    >
      {visibleFlash && (
        <div className={`mb-4 rounded p-4 text-center ${colorClasses[visibleFlash.type]}`} role="alert">
          {visibleFlash.message}
        </div>
      )}
      <Head title={title || 'Admin Dashboard'} />
      {children}
    </AppLayoutTemplate>
  );
};
