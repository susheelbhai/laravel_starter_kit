import { usePage } from '@inertiajs/react';
import { type ReactNode } from 'react';
import { type BreadcrumbItem, type SharedData } from '@/types';
import AppLayoutTemplate from '../../themes/admin_default/app/app-sidebar-layout';
import { filteredFooterNavItems, filteredMainNavItems, filteredProfileNavItems } from './side-menu';

interface AppLayoutProps {
  children: ReactNode;
  breadcrumbs?: BreadcrumbItem[];
  title?: string;
}

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
  const page = usePage<SharedData>();
  const { seller } = page.props;

  breadcrumbs = [{ title: 'Dasshboard', href: '/seller' }, ...(breadcrumbs || [])];
  const unreadNotificationsCount = page.props.seller?.unread_notifications_count ?? 0;
  const unreadNotifications = page.props.seller?.unread_notifications ?? [];
  const all_notifications_url = route('seller.notification.index');
  unreadNotifications.map((notification: any) => {
    notification.href = route('seller.notification.show', notification.id);
    return notification;
  });
  const notificationData = {
    unreadNotificationsCount,
    unreadNotifications,
    all_notifications_url,
  };

  return (
    <AppLayoutTemplate
      authUser={seller}
      mainNavItems={filteredMainNavItems}
      footerNavItems={filteredFooterNavItems}
      profileNavItems={filteredProfileNavItems}
      notificationData={notificationData}
      breadcrumbs={breadcrumbs}
      {...props}
    >

      {children}
    </AppLayoutTemplate>
  );
};
