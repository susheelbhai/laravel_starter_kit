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


  return (
    <AppLayoutTemplate
      authUser={admin}
      mainNavItems={filteredMainNavItems}
      footerNavItems={filteredFooterNavItems}
      profileNavItems={filteredProfileNavItems}
      breadcrumbs={breadcrumbs}
      {...props}
    >

      {children}
    </AppLayoutTemplate>
  );
};
