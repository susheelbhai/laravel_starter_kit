import AppLayoutTemplate from '@/layouts/admin/app/app-sidebar-layout';
import { type BreadcrumbItem } from '@/types';
import { type ReactNode } from 'react';
import { type SharedData } from '@/types';
import { usePage } from '@inertiajs/react';
import { mainNavItems, footerNavItems, profileNavItems } from './side-menu';

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
}


export default ({ children, breadcrumbs, ...props }: AppLayoutProps) => {
    const { admin } = usePage<SharedData>().props;
    return (
        <AppLayoutTemplate authUser={admin} mainNavItems={mainNavItems} footerNavItems={footerNavItems} profileNavItems={profileNavItems} breadcrumbs={breadcrumbs} {...props}>
            {children}
        </AppLayoutTemplate>
    );
};
