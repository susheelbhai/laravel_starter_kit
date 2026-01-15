import AppLayoutTemplate from '../../themes/admin_default/app/app-sidebar-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { usePage } from '@inertiajs/react';
import { type ReactNode } from 'react';
import { filteredFooterNavItems, filteredMainNavItems, filteredProfileNavItems } from './side-menu';

interface AppLayoutProps {
  children: ReactNode;
  breadcrumbs?: BreadcrumbItem[];
  title?: string;
}

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
  const page = usePage<SharedData>();
  const { partner } = page.props;

  breadcrumbs = [{ title: 'Dasshboard', href: '/partner' }, ...(breadcrumbs || [])];
  const unreadNotificationsCount = page.props.partner?.unread_notifications_count ?? 0;
  const unreadNotifications = page.props.partner?.unread_notifications ?? [];
  const all_notifications_url = route('partner.notification.index');
  unreadNotifications.map((notification: any) => {
    notification.href = route('partner.notification.show', notification.id);
    return notification;
  });
  const notificationData = {
    unreadNotificationsCount,
    unreadNotifications,
    all_notifications_url,
  };

  return (
    <AppLayoutTemplate
      authUser={partner}
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
