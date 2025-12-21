import { FlashMessage, FlashType } from '@/components/ui/alert/flash1';
import AppLayoutTemplate from '@/layouts/seller/app/app-sidebar-layout';
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
  const page = usePage<SharedData>();
  const { seller } = page.props;
  const appData = (page.props as any).appData;
  breadcrumbs = [{ title: 'Dasshboard', href: '/seller' }, ...(breadcrumbs || [])];

  const { flash = {} } = page.props as {
    flash?: Partial<Record<FlashType, string>>;
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
    }

    // ⏱ Auto-hide after 5 seconds if any flash is present
    if (flash.success || flash.warning || flash.error) {
      const timer = setTimeout(() => setVisibleFlash(null), 5000);
      return () => clearTimeout(timer);
    }
  }, [flash]);

  return (
    <AppLayoutTemplate
      authUser={seller}
      mainNavItems={mainNavItems}
      footerNavItems={footerNavItems}
      profileNavItems={profileNavItems}
      breadcrumbs={breadcrumbs}
      {...props}
    >
      <Head title={`${title || 'Admin Dashboard'} - ${appData.name}`} />

      <div className="mx-auto max-w-[1320px] items-center justify-between">
        {visibleFlash && (
          <FlashMessage
            type={visibleFlash.type}
            message={visibleFlash.message}
            onClose={() => setVisibleFlash(null)}
          />
        )}
      </div>

      {children}
    </AppLayoutTemplate>
  );
};
