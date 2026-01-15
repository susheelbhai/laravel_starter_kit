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
  const { admin } = page.props;

  breadcrumbs = [{ title: 'Dasshboard', href: '/admin' }, ...(breadcrumbs || [])];
  const unreadNotificationsCount = page.props.admin?.unread_notifications_count ?? 0;
  const unreadNotifications = page.props.admin?.unread_notifications ?? [];
  const all_notifications_url = route('admin.notification.index');
  unreadNotifications.map((notification: any) => {
    notification.href = route('admin.notification.show', notification.id);
    return notification;
  });
  const notificationData = {
    unreadNotificationsCount,
    unreadNotifications,
    all_notifications_url,
  };
  return (
    <AppLayoutTemplate
      authUser={admin}
      mainNavItems={filteredMainNavItems}
      footerNavItems={filteredFooterNavItems}
      profileNavItems={filteredProfileNavItems}
      breadcrumbs={breadcrumbs}
      notificationData={notificationData}
      {...props}
    >

      {children}
    </AppLayoutTemplate>
  );
};
